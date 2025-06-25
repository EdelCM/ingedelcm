<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'celular',
        'correo',
        'fecha_nacimiento',
        'pais_nacimiento',
        'departamento_nacimiento',
        'ciudad_nacimiento',
        'departamento_residencia',
        'ciudad_residencia',
        'barrio_residencia',
        'direccion_residencia'
    ];

    public function establecimientos()
    {
        //return $this->hasMany(Establecimiento::class, 'persona_id');
        return $this->hasMany(Establecimiento::class, 'persona_id');
    }
}
