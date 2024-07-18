<?php

namespace App\Models;

use App\Models\Devi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materiel extends Model
{
    use HasFactory;
    protected $fillable = [
        'CodeM',
        'desM'
     ];
     

    protected $primaryKey = 'CodeM';
    public $incrementing = false;

     //many materiel  can have many devis
    public function devis()
    {
        return $this->belongsToMany(Devi::class, 'depense', 'CodeM', 'NumD')
                    ->withPivot('dadeD', 'DateD')
                    ->withTimestamps();
    }
}
