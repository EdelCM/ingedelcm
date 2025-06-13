<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CaracterizacionController;
use App\Http\Controllers\CaracterizacionEstablecimientoController;

Route::get('/caracterizacion', [CaracterizacionController::class, 'create'])->name('caracterizacion.create');
Route::post('/caracterizacion', [CaracterizacionController::class, 'store'])->name('caracterizacion.store');

Route::get('/', function () {
    return view('home');
});

Route::get('/caracterizacion/establecimiento', [CaracterizacionEstablecimientoController::class, 'create'])->name('caracterizacion.establecimiento.create');
Route::post('/caracterizacion/establecimiento', [CaracterizacionEstablecimientoController::class, 'store'])->name('caracterizacion.establecimiento.store');




// en routes/web.php
Route::get('/conexion-db', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Conexión exitosa a la base de datos: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "❌ Error: " . $e->getMessage();
    }
});


Route::get('/proyectos', function () {
    return view('proyectos');
});

Route::get('/bingo', function () {
    return view('bingo');
})->name('bingo');

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/alwayswin', function () {
    return view('alwayswin');
});
