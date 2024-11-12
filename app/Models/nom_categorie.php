<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class nom_categorie extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nom_categorie'
    ];
    public function operations(): HasMany
    {
        return $this->hasMany(nom_operation::class, 'nom_categorie_id');
    }
}