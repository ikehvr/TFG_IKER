<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservas = $user->reservas()->with('itinerario')->latest()->get();
        $stats = [
            'total'       => $reservas->count(),
            'confirmadas' => $reservas->where('estado', 'confirmada')->count(),
            'pendientes'  => $reservas->where('estado', 'pendiente')->count(),
            'gastado'     => $reservas->whereIn('estado', ['confirmada', 'completada'])->sum('total'),
        ];
        return view('dashboard', compact('user', 'reservas', 'stats'));
    }
}
