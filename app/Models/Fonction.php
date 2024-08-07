<?php

namespace App\Models;

use App\Models\Ouvrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



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
