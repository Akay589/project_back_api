<?php

namespace App\Models;


use App\Models\Devis;
use App\Models\Materiel;
use Illuminate\Database\Eloquent\Model;




class Depense extends Model
{
    protected $table ='depense';
    protected $fillable = [
        'NumD', 'CodeM',  'status','DateF'
    ];
   // Indiquer que la table n'a pas de clé primaire auto-incrémentée
     public $incrementing = false;

   // Indiquer que la clé primaire n'est pas un entier
      protected $keyType = 'string' ;


    public function devis()
    {
        return $this->belongsTo(Devis::class, 'NumD');
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'CodeM');
    }
}


