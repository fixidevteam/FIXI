<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoiturePapier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'type',
        'photo',
        'note',
        'date_debut',
        'date_fin',
        'voiture_id',
    ];
    public function voiture(): BelongsTo
    {
        return $this->belongsTo(Voiture::class);
    }
}