<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RespuestaRapida extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'esta_activo' => 'boolean'
    ];
}
