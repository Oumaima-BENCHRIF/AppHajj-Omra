<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;
    
    public function facture()
    {
        return $this->belongsToMany(Factures::class);
    }
}
