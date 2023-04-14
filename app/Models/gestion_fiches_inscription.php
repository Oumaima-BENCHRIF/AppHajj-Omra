<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_fiches_inscription extends Model
{
    use HasFactory;  
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_fiches_inscriptions';
    protected $fillable = [
        'num_fichier',
        'date_fiche_inscription',
        'nom_societe',
        'bon_commande',
        'FK_programme ',
        'FK_societe ',
    ];

    protected $dates=['deleted_at'];
}
