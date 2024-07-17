<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;
    protected $primaryKey = 'CodeF';

    public $incrementing = false; // If Login is not an auto-incrementing integer

    protected $keyType = 'string'; //Define the type of the key

    protected $fillable = [
       'CodeF',
       'fonction'
    ];

    public function ouvriers()
    {
        return $this->hasMany(Ouvrier::class);
    }
}
