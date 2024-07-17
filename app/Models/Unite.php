<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;
    protected $fillable = [
        'CodeUnit',
        'unite',

     ];

     protected $primaryKey = 'CodeUnit';

     public $incrementing = false; // If Login is not an auto-incrementing integer

     protected $keyType = 'string'; //Define the type of the key


     public function devis()
     {
         return $this->hasMany(Devis::class);
     }
}
