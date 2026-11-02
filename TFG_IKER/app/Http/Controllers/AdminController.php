<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Itinerario;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'itinerarios' => Itinerario::count(),
            'usuarios'    => User::where('rol', 'user')->count(),
            'reservas'    => Reserva::count(),
            'ingresos'    => Reserva::whereIn('estado', ['confirmada', 'completada'])->sum('total'),
            'pendientes'  => Reserva::where('estado', 'pendiente')->count(),
        ];
        $ultimasReservas = Reserva::with(['user', 'itinerario'])->latest()->take(8)->get();
        return view('admin.dashboard', compact('stats', 'ultimasReservas'));
    }

    public function itinerarios(Request $request)
    {
        $itinerarios = Itinerario::query()
            ->when($request->search, fn($q) => $q->where('titulo', 'like', "%{$request->search}%"))
            ->when($request->categoria, fn($q) => $q->where('categoria', $request->categoria))
            ->orderByDesc('recomendado')->orderBy('titulo')
            ->paginate(15)->withQueryString();
        return view('admin.itinerarios.index', compact('itinerarios'));
    }

    public function itinerarioCreate()
    {
        return view('admin.itinerarios.form', ['itinerario' => null]);
    }

    public function itinerarioStore(Request $request)
    {
        $data = $this->validar($request);
        $data['slug']        = Str::slug($data['titulo']);
        $data['recomendado'] = $request->boolean('recomendado');
        $data['activo']      = $request->boolean('activo', true);
        if ($request->hasFile('imagen_principal')) {
            $nombre = $request->file('imagen_principal')->getClientOriginalName();
            $request->file('imagen_principal')->move(public_path('images/itinerarios'), $nombre);
            $data['imagen_principal'] = '/images/itinerarios/' . $nombre;
        }
        Itinerario::create($data);
        return redirect()->route('admin.itinerarios')->with('success', 'Itinerario creado.');
    }

    public function itinerarioEdit(Itinerario $itinerario)
    {
        return view('admin.itinerarios.form', compact('itinerario'));
    }

    public function itinerarioUpdate(Request $request, Itinerario $itinerario)
    {
        $data = $this->validar($request);
        $data['recomendado'] = $request->boolean('recomendado');
        $data['activo']      = $request->boolean('activo');
        if ($request->hasFile('imagen_principal')) {
            $nombre = $request->file('imagen_principal')->getClientOriginalName();
            $request->file('imagen_principal')->move(public_path('images/itinerarios'), $nombre);
            $data['imagen_principal'] = '/images/itinerarios/' . $nombre;
        }
        $itinerario->update($data);
        return redirect()->route('admin.itinerarios')->with('success', 'Itinerario actualizado.');
    }

    public function itinerarioDestroy(Itinerario $itinerario)
    {
        if ($itinerario->reservas()->whereIn('estado', ['confirmada', 'pendiente'])->exists()) {
            return back()->with('error', 'No se puede eliminar: tiene reservas activas.');
        }
        $itinerario->delete();
        return back()->with('success', 'Itinerario eliminado.');
    }

    public function reservas(Request $request)
    {
        $reservas = Reserva::with(['user', 'itinerario'])
            ->when($request->estado, fn($q) => $q->where('estado', $request->estado))
            ->latest()->paginate(20)->withQueryString();
        return view('admin.reservas.index', compact('reservas'));
    }

    public function reservaUpdate(Request $request, Reserva $reserva)
    {
        $request->validate(['estado' => 'required|in:pendiente,confirmada,cancelada,completada']);
        $reserva->update(['estado' => $request->estado]);
        return back()->with('success', 'Reserva actualizada.');
    }

    public function usuarios(Request $request)
    {
        $usuarios = User::withCount('reservas')
            ->when($request->search, fn($q) =>
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%"))
            ->latest()->paginate(20)->withQueryString();
        return view('admin.usuarios', compact('usuarios'));
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'titulo'            => 'required|string|max:255',
            'descripcion_corta' => 'required|string|max:500',
            'descripcion_larga' => 'nullable|string',
            'duracion_dias'     => 'required|integer|min:1|max:30',
            'categoria'         => 'required|in:tradicional,moderno,anime,naturaleza,mixto',
            'presupuesto'       => 'required|in:economico,medio,lujo',
            'primera_vez'       => 'required|in:si,no',
            'precio_desde'      => 'required|numeric|min:0',
            'destino_principal' => 'required|string|max:100',
            'imagen_principal'  => 'nullable|image|max:3072',
        ]);
    }
}
