<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voiture extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_immatriculation',
        'marque',
        'modele',
        'photo',
        'date_de_première_mise_en_circulation',
        'date_achat',
        'date_de_dédouanement',
        'user_id'

    ];
    public function papiersVoiture(): HasMany
    {
        return $this->hasMany(PapierVoiture::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }
}
