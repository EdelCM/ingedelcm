<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class CaracterizacionEstablecimientoController extends Controller
{
    public function create()
    {
        $personas = \App\Models\Persona::all();
        return view('caracterizacion.establecimiento');
    }

    public function store(Request $request)
    {
        // Validación más robusta
        $validatedData = $request->validate([
            'nit_establecimiento'  => [
                'required',
                'string',
                'max:20',
                'unique:establecimientos,nit_establecimiento',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[0-9]{5,10}-[0-9]{1}$/', $value)) {
                        $fail('El formato del NIT es incorrecto. Debe contener solo números y un guion (Ejemplo: 123456789-0).');
                    }
                }
            ],

            'nombre_establecimiento' => 'required|string|max:100',
            'tipo_establecimiento' => 'required|string|max:50',
            'ciudad' => 'required|string|max:50',
            'direccion' => 'required|string',
            'telefono_contacto' => 'nullable|string|max:20',
            'email_contacto' => 'nullable|email|max:100'
        ]);

        try {
            DB::beginTransaction();

            Log::info('Creando establecimiento con datos:', $validatedData);

            $establecimiento = Establecimiento::create($validatedData);

            DB::commit();

            return redirect()->route('caracterizacion.establecimiento.create')->with('swal-success', '¡Establecimiento registrado exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear establecimiento: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('swal-error', 'Error al registrar: ' . $e->getMessage());
        }
    }
}
