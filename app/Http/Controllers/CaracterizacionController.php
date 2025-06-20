<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TipoDocumento;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Departamento;

class CaracterizacionController extends Controller
{
     // 🧾 Mostrar el formulario
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
public function getCiudades(Request $request)
{
    $ciudades = Ciudad::where('departamento_id', $request->departamento_id)->get();
    return response()->json($ciudades);
}

    // ✅ Procesar el formulario y guardar en base de datos
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'tipo_documento' => 'required|string|max:5',
            'numero_documento' => 'required|string|max:20|unique:personas,numero_documento',
            'primer_nombre' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'celular' => 'required|string|max:20',
            'pais_nacimiento' => 'required|string|max:50',
            'departamento_nacimiento' => 'required|string',
            'ciudad_nacimiento' => 'required|string',
            'departamento_residencia' => 'required|string',
            'ciudad_residencia' => 'required|string',
            'barrio_residencia' => 'required|string',
            'direccion_residencia' => 'required|string',
            'nombre_establecimiento' => 'required|string',
            'tipo_establecimiento' => 'required|string',
            'ciudad_establecimiento' => 'required|string',
            'direccion_establecimiento' => 'required|string'
        ]);

        // Transacción de persona y establecimiento
        DB::beginTransaction();

        try {
            $persona_id = DB::table('personas')->insertGetId([
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

            DB::table('establecimientos')->insert([
                'persona_id' => $persona_id,
                'nombre_establecimiento' => $request->nombre_establecimiento,
                'tipo_establecimiento' => $request->tipo_establecimiento,
                'ciudad' => $request->ciudad_establecimiento,
                'direccion' => $request->direccion_establecimiento,
                'telefono_contacto' => $request->telefono_establecimiento,
                'email_contacto' => $request->email_establecimiento
            ]);

            DB::commit();

            return redirect()->back()->with('success', '¡Registro exitoso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }
}
