<?php

namespace App\Models;

use App\Models\Devi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unite extends Model
{
    use HasFactory;

    protected $fillable = [
        'CodeUnit',
        'unite'
     ];
 
     protected $primaryKey = 'CodeUnit';
     //one unite can have many devis
     public function devis()
     {
         return $this->hasMany(Devi::class);
     }
 }

