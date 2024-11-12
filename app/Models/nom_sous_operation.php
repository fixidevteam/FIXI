<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class nom_sous_operation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nom_sous_operation',
        'nom_operation_id'
    ];
    public function operation(): BelongsTo
    {
        return $this->belongsTo(nom_operation::class, 'nom_operation_id');
    }
}