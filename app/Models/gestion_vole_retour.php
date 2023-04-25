<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_vole_retour extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_vole__reetours';
    protected $fillable = [
        'date_retour',
        'num_vol',
        'parcours',
        'total_accorde',
        'FK_allotement',
        'FK_parcours',
        'prix_Achat_retour',
        'prix_vente_retour',
        'heure_depart',
        'heure_arrivee',
    ];

    protected $dates = ['deleted_at'];
}
