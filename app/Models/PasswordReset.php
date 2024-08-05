<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;


    public $table = 'password_resets';

    protected $primaryKey = 'mailU'; //define the primary key
    public $timestamps = false;

    protected $fillable = [
        'mailU',
        'token',
        'created_at'
    ];
}
