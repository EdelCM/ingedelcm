<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaEstablecimiento extends Model
{
    protected $table = 'persona_establecimiento';

    protected $fillable = [
        'persona_id',
        'establecimiento_id',
        'tipo_relacion'
    ];

    /**
     * Relación con Persona
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    /**
     * Relación con Establecimiento
     */
    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }
}
