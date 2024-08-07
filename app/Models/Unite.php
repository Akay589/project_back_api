<?php

namespace App\Models;

use App\Models\Devis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
