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
        'voiture_id'
    ];
    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class);
    }
    public function sousOperation(): HasMany
    {
        return $this->hasMany(SousOperation::class);
    }
}