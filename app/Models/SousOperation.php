<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SousOperation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'operation_id'
    ];
    public function operation(): BelongsTo
    {
        return $this->belongsTo(Operation::class);
    }
}