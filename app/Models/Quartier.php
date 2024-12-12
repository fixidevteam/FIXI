<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quartier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'quartier',
        'ville_id',
    ];
    public function ville(): BelongsTo
    {
        return $this->belongsTo(Ville::class);
    }
}