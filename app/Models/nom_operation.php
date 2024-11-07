<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class nom_operation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_operation',
        'nom_categorie_id'
    ];
    public function categorie():BelongsTo{
        return $this->BelongsTo(nom_categorie::class);
    }
    public function sousOperations():HasMany{
        return $this->hasMany(nom_sous_operation::class);
    }
    

}
