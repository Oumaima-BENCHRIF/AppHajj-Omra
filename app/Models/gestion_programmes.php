<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_programmes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion__programmes';
    protected $fillable = [
        'ref_programme',
        'nom_programme',
        'type_programme',
        'nbr_nuitee_prog_mdina',
        'nbr_nuitee_prog_maka',
        'FK_Num_vole_depart',
        'Nbr_place_aller',
        'Nbr_reserver_depart',
        'FK_Num_vole_retour',
        'Nbr_place_retour',
        'Nbr_reserver_retour',
        'FK_dossier',
        
    ];

    protected $dates = ['deleted_at'];
}
