<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Establecimiento extends Model
{
    protected $table = 'establecimientos';
    public $timestamps = false;
    protected $fillable = [
        'nit_establecimiento',
        'nombre_establecimiento',
        'tipo_establecimiento',
        'departamento_id',
        'ciudad_id',
        'direccion',
        'telefono_contacto',
        'email_contacto',
        'fecha_registro'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    /**
     * Relación muchos a muchos con Persona a través de la tabla pivote
     *
     * @return BelongsToMany
     */
    public function personas(): BelongsToMany
    {
        return $this->belongsToMany(Persona::class, 'persona_establecimiento')
            ->withPivot('tipo_relacion', 'created_at', 'updated_at')
            ->withTimestamps();
    }

    /**
     * Obtiene solo los propietarios del establecimiento
     */
    public function propietarios()
    {
        return $this->personas()->wherePivot('tipo_relacion', 'propietario');
    }

    /**
     * Obtiene solo los socios del establecimiento
     */
    public function socios()
    {
        return $this->personas()->wherePivot('tipo_relacion', 'socio');
    }
}
