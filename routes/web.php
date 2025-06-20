<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\CaracterizacionController;
use App\Http\Controllers\CaracterizacionEstablecimientoController;

/*Route::get('/caracterizacion', [CaracterizacionController::class, 'create']);*/

Route::get('/caracterizacion', [CaracterizacionController::class, 'create'])->name('caracterizacion.create');

Route::get('/get-departamentos', [CaracterizacionController::class, 'getPais']);
Route::get('/get-departamentos', [CaracterizacionController::class, 'getDepartamentos']);
Route::get('/get-ciudades', [CaracterizacionController::class, 'getCiudades']);

Route::get('/ciudades-por-departamento/{departamento_id}', [CaracterizacionController::class, 'getCiudades']);


Route::post('/caracterizacion', [CaracterizacionController::class, 'store'])->name('caracterizacion.store');

Route::get('/caracterizacion/establecimiento', [CaracterizacionEstablecimientoController::class, 'create'])->name('caracterizacion.establecimiento.create');
Route::post('/caracterizacion/establecimiento', [CaracterizacionEstablecimientoController::class, 'store'])->name('caracterizacion.establecimiento.store');

Route::get('/', function () {
    return view('home');
});

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

/*Route::get('/caracterizacion', function () {
    return view('caracterizacion.formularioCaracterizacion');
});*/
