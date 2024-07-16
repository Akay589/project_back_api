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



     public function devis()
     {
         return $this->hasMany(Devis::class);
     }
}
