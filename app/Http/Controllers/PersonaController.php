<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);

        $personas = Persona::query()
            ->when($search, function ($query, $search) {
                $query->where('numero_documento', 'like', "%$search%")
                      ->orWhere('primer_nombre', 'like', "%$search%")
                      ->orWhere('segundo_nombre', 'like', "%$search%")
                      ->orWhere('primer_apellido', 'like', "%$search%")
                      ->orWhere('segundo_apellido', 'like', "%$search%")
                      ->orWhere('celular', 'like', "%$search%");
            })
            ->orderBy('primer_nombre')
            ->paginate($perPage);

        return view('personas.index', compact('personas'));
    }
}
