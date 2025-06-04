<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\AnimacionController;

// Redirección de la ruta raíz a la lista de animaciones
Route::get('/', fn() => redirect()->route('animaciones.index'));

// Agrupamos las rutas con un middleware si es necesario (ej: auth)
// Route::middleware(['auth'])->group(function () {
    Route::resource('estudios', EstudioController::class);
Route::resource('animaciones', AnimacionController::class)->parameters([
    'animaciones' => 'animacion',
]);
// });
