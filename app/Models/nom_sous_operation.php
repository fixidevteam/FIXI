<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class nom_sous_operation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_sous_operation',
        'nom_operation_id'
    ];
    public function operation():BelongsTo{
        return $this->BelongsTo(nom_operation::class);
    }
}
