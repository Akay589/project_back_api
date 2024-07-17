<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;
    protected $primaryKey = 'CodeM';
    protected $fillable = [
        'CodeM',
        'desM'


     ];


     public $incrementing = false; // If Login is not an auto-incrementing integer

     protected $keyType = 'string'; //Define the type of the key


     public function devis()
     {
         return $this->belongsToMany(Devis::class, 'depense', 'CodeM', 'NumD')
                     ->withPivot('dadeD', 'DateD')
                     ->withTimestamps();
     }
}
