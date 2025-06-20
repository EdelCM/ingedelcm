<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipos_documento'; // 👈 Nombre real de la tabla

    public $timestamps = false; // 👈 Si no tienes campos created_at/updated_at
}
