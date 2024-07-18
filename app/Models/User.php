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
    protected $primaryKey = 'Login';

    public $incrementing = false; // If Login is not an auto-incrementing integer

    protected $keyType = 'string'; //

    protected $fillable = [
        'Login',
        'mdp',
         'nomU',
        'telU',
         'mailU',
        'role_id',
        'AdresseConstruction'
     ];

     public function role()
     {
         return $this->belongsTo(Role::class);
     }

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
            'email_verified_at' => 'datetime',
            'mdp' => 'hashed',
        ];
    }
}
