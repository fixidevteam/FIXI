<?php

namespace App\Models;


// implements MustVerifyEmail

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ville',
        'quartier',
        'provider',
        'provider_id',
        'provider_token',
        'telephone',
        'status',
        'created_by_mechanic',
        'mechanic_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // relations :
    public function papiersUsers(): HasMany
    {
        return $this->hasMany(UserPapier::class);
    }
    public function voitures(): HasMany
    {
        return $this->hasMany(Voiture::class);
    }
    // check the status of the user account : 
    public function isActive()
    {
        return $this->status === true; // Check if the status is active
    }
}