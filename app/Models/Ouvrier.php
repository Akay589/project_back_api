<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrier extends Model
{
    protected $fillable = [
        'CodeO',
        'NomO',
         'PrenO',
        'CodeF',
         'CIN',
        'Contact',

     ];

     protected $primaryKey = 'CodeO';

     public $incrementing = false; // If Login is not an auto-incrementing integer

     protected $keyType = 'string'; //Define the type of the key

     public function fonction()
     {
         return $this->belongsTo(Fonction::class);
     }

     public function devis()
     {
         return $this->hasMany(Devis::class);
     }
}
