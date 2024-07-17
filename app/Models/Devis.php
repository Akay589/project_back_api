<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
      'NumD',
     'DateDv',
     'Login',
     'CodeO',
     'PrixU',
     'CodeUnit',
     'Montant',
      'type'
    ];

     protected $primaryKey = 'NumD';


     public $incrementing = false; // If Login is not an auto-incrementing integer

     protected $keyType = 'integer'; //Define the type of the key



     public function materiels()
     {
         return $this->belongsToMany(Materiel::class, 'depense', 'NumD', 'CodeM')
                     ->withPivot('dadeD', 'DateD')
                     ->withTimestamps();
     }

    public function ouvrier()
    {
        return $this->belongsTo(Ouvrier::class);
    }

    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
