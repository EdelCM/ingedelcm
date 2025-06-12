<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
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
