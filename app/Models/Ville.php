<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ville extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'ville',
    ];
    public function quartiers(): HasMany
    {
        return $this->hasMany(Quartier::class);
    }
}