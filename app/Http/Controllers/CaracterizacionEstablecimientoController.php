<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaracterizacionEstablecimientoController extends Controller
{
    public function create()
    {
        return view('caracterizacion.establecimiento');
    }

    public function store(Request $request)
    {
        // Validaciones y guardado...
    }

}
