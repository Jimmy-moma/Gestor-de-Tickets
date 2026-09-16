<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticuloFaq extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'esta_publicado' => 'boolean'
    ];

    public function categoria(): BelongsTo{
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
