<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItinerarioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Admin\AdminController;

// Pagina principal
Route::get('/', [ItinerarioController::class, 'home'])->name('home');

// Itinerarios publicos
Route::post('/buscar', [ItinerarioController::class, 'buscar'])->name('itinerarios.buscar');
Route::get('/buscar',  [ItinerarioController::class, 'buscar'])->name('itinerarios.buscar.get');
Route::get('/categoria/{categoria}', [ItinerarioController::class, 'categoria'])->name('itinerarios.categoria');
Route::get('/itinerario/{slug}',     [ItinerarioController::class, 'show'])->name('itinerarios.show');
Route::get('/itinerarios',           [ItinerarioController::class, 'index'])->name('itinerarios.index');

// Contacto (publico)
Route::get('/contacto',  [ContactoController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'send'])->name('contacto.send');

// Politica de privacidad (publica)
Route::get('/privacidad', function () {
    return view('paginas.privacidad');
})->name('privacidad');

// Sobre nosotros (publica)
Route::get('/sobre-nosotros', function () {
    return view('paginas.sobre-nosotros');
})->name('sobre-nosotros');

// Zona privada usuario
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reservas
    Route::post('/reservas',                    [ReservaController::class, 'store'])->name('reservas.store');
    Route::get('/reservas/{reserva}',            [ReservaController::class, 'show'])->name('reservas.show');
    Route::get('/reservas/{reserva}/checkout',   [ReservaController::class, 'checkout'])->name('reservas.checkout');
    Route::post('/reservas/{reserva}/pagar',     [ReservaController::class, 'pagar'])->name('reservas.pagar');
    Route::get('/reservas/{reserva}/recibo',     [ReservaController::class, 'recibo'])->name('reservas.recibo');
    Route::post('/reservas/{reserva}/cancelar',  [ReservaController::class, 'cancelar'])->name('reservas.cancelar');

    // Comentarios
    Route::post('/itinerario/{slug}/comentario',         [ResenaController::class, 'store'])->name('resenas.store');
    Route::delete('/comentario/{resena}',                [ResenaController::class, 'destroy'])->name('resenas.destroy');
});

// Panel administracion
Route::middleware(['auth', 'is.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                                    [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/itinerarios',                         [AdminController::class, 'itinerarios'])->name('itinerarios');
    Route::get('/itinerarios/crear',                   [AdminController::class, 'itinerarioCreate'])->name('itinerarios.create');
    Route::post('/itinerarios',                        [AdminController::class, 'itinerarioStore'])->name('itinerarios.store');
    Route::get('/itinerarios/{itinerario}/editar',     [AdminController::class, 'itinerarioEdit'])->name('itinerarios.edit');
    Route::put('/itinerarios/{itinerario}',            [AdminController::class, 'itinerarioUpdate'])->name('itinerarios.update');
    Route::delete('/itinerarios/{itinerario}',         [AdminController::class, 'itinerarioDestroy'])->name('itinerarios.destroy');
    Route::get('/reservas',                            [AdminController::class, 'reservas'])->name('reservas');
    Route::patch('/reservas/{reserva}',                [AdminController::class, 'reservaUpdate'])->name('reservas.update');
    Route::get('/usuarios',                            [AdminController::class, 'usuarios'])->name('usuarios');
});

require __DIR__.'/auth.php';
