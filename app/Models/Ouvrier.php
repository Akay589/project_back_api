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

     public function fonction()
     {
         return $this->belongsTo(Fonction::class);
     }

     public function devis()
     {
         return $this->hasMany(Devis::class);
     }
}
