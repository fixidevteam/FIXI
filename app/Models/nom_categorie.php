<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class nom_categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_categorie'
    ];
    public function operations():HasMany{
        return $this->hasMany(nom_operation::class);
    }
}
