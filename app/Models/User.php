<?php

namespace App\Models;

use App\Models\Role;

use App\Models\Devis;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;




    protected $fillable = [
        'Login',
        'mdp',
         'nomU',
        'telU',
         'mailU',
        'AdresseConstruction'
     ];



     public function devis()
     {
         return $this->hasMany(Devis::class);
     }


       /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mdp',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'mailU_verified_at' => 'datetime',
            'mdp' => 'hashed',
        ];
    }
}
