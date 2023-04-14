<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_Categorie extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion__categories';
    protected $fillable = [
        'num_categorie',
        'nom_categorie',
        'Nbre_pax',
        'remis',
        'date',
        'FK_type',
    ];

    protected $dates=['deleted_at'];
}
