<?php

namespace App\Models;

use App\Models\Ouvrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fonction extends Model
{
    use HasFactory;
    protected $fillable = [
        'CodeF',
        'fonction'
     ];
     
     protected $primaryKey = 'CodeF';
     //one fonction can have many ouvriers
     public function ouvriers()
     {
         return $this->hasMany(Ouvrier::class);
     }
}
