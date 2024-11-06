<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPapier extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'photo',
        'note',
        'date_debut',
        'date_fin',
        'user_id'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}