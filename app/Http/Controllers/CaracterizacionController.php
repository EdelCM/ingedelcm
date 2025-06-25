<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Persona;
use App\Models\Establecimiento;
use App\Models\TipoDocumento;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Departamento;

class CaracterizacionController extends Controller
{
    // 🧾 Mostrar formulario
    public function create()
    {
        $tipos_documento = TipoDocumento::orderBy('id', 'asc')->get();
        $paises = Pais::all();
        $paisDefault = Pais::where('nombre', 'Colombia')->first();
        $departamentos = Departamento::where('pais_id', $paisDefault->id)->get();

        return view('caracterizacion.formularioCaracterizacion', compact(
            'tipos_documento',
            'paises',
            'paisDefault',
            'departamentos'
        ));
    }

    // ⚙️ Obtener ciudades por departamento (AJAX)
    public function getCiudades(Request $request)
    {
        $ciudades = Ciudad::where('departamento_id', $request->departamento_id)->get();
        return response()->json($ciudades);
    }

    // ✅ Guardar la información en BD
    public function store(Request $request)
{
    try {
        // Validación de datos (solo persona)
        $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'numero_documento' => 'required|string|max:20|unique:personas,numero_documento',
            'primer_nombre' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'celular' => 'required|string|max:20',
            'pais_nacimiento' => 'required|string',
            'departamento_nacimiento' => 'required|string',
            'ciudad_nacimiento' => 'required|string',
            'departamento_residencia' => 'required|string',
            'ciudad_residencia' => 'required|string',
            'barrio_residencia' => 'required|string',
            'direccion_residencia' => 'required|string',
        ]);

        // Log de los datos recibidos
        Log::info('Datos de persona recibidos:', $request->all());

        // Crear persona con Eloquent
        \App\Models\Persona::create([
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'pais_nacimiento' => $request->pais_nacimiento,
            'departamento_nacimiento' => $request->departamento_nacimiento,
            'ciudad_nacimiento' => $request->ciudad_nacimiento,
            'departamento_residencia' => $request->departamento_residencia,
            'ciudad_residencia' => $request->ciudad_residencia,
            'barrio_residencia' => $request->barrio_residencia,
            'direccion_residencia' => $request->direccion_residencia
        ]);

        return redirect()->back()->with('success', true);
    } catch (\Throwable $e) {
        Log::error('❌ Error al registrar persona: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error inesperado al registrar: ' . $e->getMessage());
    }
}


}
