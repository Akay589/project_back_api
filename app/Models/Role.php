<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
       'role',
    ];

    //one role can have many users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
