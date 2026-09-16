<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $casts = [
        'resuelto_en' => 'datetime',
        'cerrado_en' => 'datetime'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }


    public function agenteAsignado(): BelongsTo{
        return $this->belongsTo(User::class, 'asignado_a');
    }

    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function respuestas(): HasMany {
        return $this->hasMany(RespuestaTicket::class, 'ticket_id');
    }

    public function adjuntos(): HasMany{
        return $this->hasMany(ArchivoAdjuntoTicket::class, 'ticket_id');
    }

    
}
