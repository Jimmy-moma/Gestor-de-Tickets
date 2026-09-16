<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RespuestaTicket extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'es_nota_interna' => 'boolean'
    ];    

    public function ticket(): BelongsTo{
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adjuntos(): HasMany{
        return $this->hasMany(ArchivoAdjuntoTicket::class, 'ticket_id');
    }
    

    
}
