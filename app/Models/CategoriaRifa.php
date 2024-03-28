<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaRifa extends Model
{
    use HasFactory;

    public function rifa(): HasMany
    {
        return $this->hasMany(Rifa::class);
    }
}
