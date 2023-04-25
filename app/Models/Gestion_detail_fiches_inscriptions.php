<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gestion_detail_fiches_inscriptions extends Model
{
    use HasFactory;  
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_detail_fiches_inscriptions';
    protected $fillable = [
        'num_ligne',
        'nom_client',
        'prenom_client',
        'nom_arabe',
        'prenom_arabe',
        'upload_img',
        'num_GSM',
        'num_CIN',
        'Email',
        'prix',
        'genre',
        'num_passeport',
        'date_naissance',
        'adresse',
        'date_expiration',
        'situation_familiale',
        'telephone',
        'date_obtention_visa',
        'num_visa',
        'date_delivrance',
        'Province',
        'date_expiration_visa',
        'etat_passeport',
        'Num_Inscription',
        'Type_visa',
        'Lieu_delivrance',
        'num_agence',
        'img_pass',
        'bon_commande',
        'FK_programme',
        'FK_type_chambre',
        'FK_accompagnateurs', 
        'Fk_fiche_inscription', 
        'FK_detail_hotel_prg', 
        // 'FK_inclus',
    ];

    protected $dates=['deleted_at'];
}
