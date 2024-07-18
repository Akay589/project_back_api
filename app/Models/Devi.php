<?php

namespace App\Models;

use App\Models\User;
use App\Models\Unite;
use App\Models\Ouvrier;
use App\Models\Materiel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devi extends Model
{
    use HasFactory;

    protected $fillable = [
        'NumD',
        'DateDv',
        'Login',
        'CodeO',
        'PrixU',
        'CodeUnit',
        'Montant'
    ];
    protected $primaryKey = 'NumD';
    public $incrementing = false;
    
    //Many devis  can have Many material
    public function materiels()
    {
        return $this->belongsToMany(Materiel::class, 'depense', 'NumD', 'CodeM')
                    ->withPivot('dadeD', 'DateD')
                    ->withTimestamps();
    }

    //one devis  only have onr user
        public function user()
    {
        return $this->belongsTo(User::class);
    }

    //one devis  only have one ouvrier
    public function ouvrier()
    {
        return $this->belongsTo(Ouvrier::class);
    }

    
    //one devis  only have one unite
    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }
}
