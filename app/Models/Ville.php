<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ville extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'ville',
    ];
    public function quartiers(): HasMany
    {
        return $this->hasMany(Quartier::class);
    }
    // Assuming 'ville' in Garage matches 'name' in Ville
    public function garages()
    {
        return $this->hasMany(garage::class, 'ville', 'ville'); // Adjust column names as needed
    }
}