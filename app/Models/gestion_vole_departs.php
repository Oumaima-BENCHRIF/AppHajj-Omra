<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_vole_departs extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_vole__deeparts';
    protected $fillable = [
        'date_depart',
        'num_vol',
        'total_accorde',
        'heure_depart',
        'heure_arrivee',
        'FK_allotement',
        'prix_Achat_dep',
        'prix_vente_dep',
        'FK_parcours'
    ];

    protected $dates = ['deleted_at'];
}
