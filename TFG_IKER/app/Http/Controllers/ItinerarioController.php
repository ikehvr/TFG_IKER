<?php

namespace App\Http\Controllers;

use App\Models\Itinerario;
use Illuminate\Http\Request;

class ItinerarioController extends Controller
{
    // Pagina principal
    public function home()
    {
        $destacados = Itinerario::activo()->destacado()->limit(6)->get();
        $categorias = [
            'tradicional' => Itinerario::activo()->where('categoria', 'tradicional')->count(),
            'moderno'     => Itinerario::activo()->where('categoria', 'moderno')->count(),
            'anime'       => Itinerario::activo()->where('categoria', 'anime')->count(),
            'naturaleza'  => Itinerario::activo()->where('categoria', 'naturaleza')->count(),
        ];
        return view('itinerarios.index', compact('destacados', 'categorias'));
    }

    // Listado completo
    public function index()
    {
        $destacados  = Itinerario::activo()->destacado()->limit(6)->get();
        $categorias  = [
            'tradicional' => Itinerario::activo()->where('categoria', 'tradicional')->count(),
            'moderno'     => Itinerario::activo()->where('categoria', 'moderno')->count(),
            'anime'       => Itinerario::activo()->where('categoria', 'anime')->count(),
            'naturaleza'  => Itinerario::activo()->where('categoria', 'naturaleza')->count(),
            'mixto'         => Itinerario::activo()->where('categoria', 'mixto')->count(),
        ];
        return view('itinerarios.index', compact('destacados', 'categorias'));
    }

    // Buscador
    public function buscar(Request $request)
    {
        $primeraVez = $request->input('primera_vez') ?? $request->input('primera-vez') ?? 'todos';

        $itinerarios = Itinerario::activo()
            ->duracion($request->dias)
            ->estilo($request->estilo)
            ->presupuesto($request->presupuesto)
            ->primeraVez($primeraVez)
            ->orderByDesc('recomendado')
            ->get();

        $filtros = [
            'dias'        => $request->dias        ?? 'todos',
            'estilo'      => $request->estilo       ?? 'todos',
            'presupuesto' => $request->presupuesto  ?? 'todos',
            'primera_vez' => $primeraVez,
        ];

        return view('itinerarios.resultados', compact('itinerarios', 'filtros'));
    }

    // Detalle
    public function show(string $slug)
    {
        $itinerario = Itinerario::activo()
            ->where('slug', $slug)
            ->with(['destinos', 'resenas.user'])
            ->firstOrFail();

        $relacionados = Itinerario::activo()
            ->where('categoria', $itinerario->categoria)
            ->where('id', '!=', $itinerario->id)
            ->limit(3)
            ->get();

        return view('itinerarios.show', compact('itinerario', 'relacionados'));
    }

    // Por categoria
    public function categoria(string $categoria)
    {
        $validas = ['tradicional', 'moderno', 'anime', 'naturaleza', 'mixto'];
        if (!in_array($categoria, $validas)) abort(404);

        $itinerarios = Itinerario::activo()
            ->where('categoria', $categoria)
            ->orderByDesc('recomendado')
            ->paginate(9);

        return view('itinerarios.categoria', compact('itinerarios', 'categoria'));
    }
}
