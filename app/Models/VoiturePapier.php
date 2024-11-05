<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoiturePapier extends Model
{
    use HasFactory; 
 
    protected $fillable = [
        'type',
        'photo',
        'note',
        'date_debut',
        'date_fin',
        'voiture_id'
    ];
    public function voiture():BelongsTo
    {
        return $this->belongsTo(Voiture::class);
    }
}