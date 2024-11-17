<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class nom_operation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nom_operation',
        'nom_categorie_id'
    ];
    public function operations(): HasMany
    {
        return $this->HasMany(Operation::class);
    }
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(nom_categorie::class, 'nom_categorie_id');
    }
    public function sousOperations(): HasMany
    {
        return $this->hasMany(nom_sous_operation::class);
    }
}