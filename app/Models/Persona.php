<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Relación muchos a muchos con Establecimiento a través de la tabla pivote
     *
     * @return BelongsToMany
     */
    public function establecimientos(): BelongsToMany
    {
        return $this->belongsToMany(Establecimiento::class, 'persona_establecimiento')
                    ->withPivot('tipo_relacion', 'created_at', 'updated_at')
                    ->withTimestamps();
    }

    /**
     * Obtiene solo los establecimientos donde es propietario
     */
    public function establecimientosComoPropietario()
    {
        return $this->establecimientos()->wherePivot('tipo_relacion', 'propietario');
    }

    /**
     * Obtiene solo los establecimientos donde es socio
     */
    public function establecimientosComoSocio()
    {
        return $this->establecimientos()->wherePivot('tipo_relacion', 'socio');
    }

    /**
     * Método para buscar personas por diferentes criterios
     */
    public static function buscar($query)
    {
        return self::where('numero_documento', 'like', "%$query%")
                    ->orWhere('primer_nombre', 'like', "%$query%")
                    ->orWhere('primer_apellido', 'like', "%$query%")
                    ->orWhere('celular', 'like', "%$query%")
                    ->limit(10)
                    ->get();
    }
}
