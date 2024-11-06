<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voiture extends Model
{
    use HasFactory;
    use SoftDeletes;
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
        return $this->hasMany(VoiturePapier::class);
    }
    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}