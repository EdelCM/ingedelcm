<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    protected $table = 'establecimientos';

    protected $fillable = [
        'persona_id',
        'nit_establecimiento',
        'nombre_establecimiento',
        'tipo_establecimiento',
        'ciudad',
        'direccion',
        'telefono_contacto',
        'email_contacto',
    ];

    public function persona()
    {
        //return $this->belongsTo(Persona::class, 'persona_id');
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
