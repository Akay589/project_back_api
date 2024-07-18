<?php

namespace App\Models;

use App\Models\Devi;
use App\Models\Fonction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ouvrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'CodeO',
        'NomO',
        'PrenO',
        'CodeF',
        'CIN',
        'contact'
     ];
     protected $primaryKey = 'CodeO';
 
     //one ouvrier can have many devis
     public function devis()
     {
         return $this->hasMany(Devi::class);
     }
     //one ouvrier only have one fonction
     public function fonction()
     {
         return $this->belongsTo(Fonction::class);
     }
}
