<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class garage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ref',
        'photo',
        'ville',
        'quartier',
        'localisation',
        'user_id',
        'virtualGarage',
        'services'
    ];
    protected $casts = [
        'services' => 'array',
    ];
    public function mechanics(): HasMany
    {
        return $this->hasMany(Mechanic::class);
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