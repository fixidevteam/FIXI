<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_promotion',
        'ville',
        'date_debut',
        'date_fin',
        'lien_promotion',
        'garage_id',
        'photo_promotion',
        'description',
    ];


    /**
     * Define the relationship with the Garage model.
     */
    public function garage()
    {
        return $this->belongsTo(garage::class);
    }
}