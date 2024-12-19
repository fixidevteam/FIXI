<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'categorie',
        'nom',
        'description',
        'date_operation',
        'photo',
        'voiture_id',
        'garage_id',
        'autre_operation',
        'create_by'
    ];
    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class);
    }
    public function garage(): BelongsTo
    {
        return $this->belongsTo(garage::class);
    }
    public function sousOperations(): HasMany
    {
        return $this->hasMany(SousOperation::class);
    }
    public function nom_operation(): BelongsTo
    {
        return $this->belongsTo(nom_operation::class);
    }
}