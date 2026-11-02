<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\Itinerario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResenaController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $request->validate([
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|min:10|max:500',
        ]);

        $itinerario = Itinerario::where('slug', $slug)->firstOrFail();

        // Comprobar si ya ha comentado
        $existe = Resena::where('user_id', Auth::id())
                        ->where('itinerario_id', $itinerario->id)
                        ->exists();

        if ($existe) {
            return back()->with('error', 'Ya has dejado un comentario en este itinerario.');
        }

        Resena::create([
            'user_id'       => Auth::id(),
            'itinerario_id' => $itinerario->id,
            'puntuacion'    => $request->puntuacion,
            'comentario'    => $request->comentario,
            'verificada'    => true,
        ]);

        return back()->with('success', 'Comentario publicado. Gracias!');
    }

    public function destroy(Resena $resena)
    {
        // Solo el autor o admin puede borrar
        if (Auth::id() !== $resena->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        $resena->delete();
        return back()->with('success', 'Comentario eliminado.');
    }
}
