<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function tickets(): HasMany{
        return $this->hasMany(Ticket::class, 'categoria_id');
    }

    public function articulosFaq(): HasMany{
        return $this->hasMany(ArticuloFaq::class, 'categoria_id');
    }

    
}
