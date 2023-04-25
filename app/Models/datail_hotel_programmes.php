<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class datail_hotel_programmes extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_datail_hotel_programmes';
    protected $fillable = [
        'ref_Hotels_prog',
        'ville_Hotel_prg',
        'date_depar_hotel',
        'date_retour_hotel',
        'hotel_prg',
        'bnr_nuits_prg',
        'regime_prg',
        'type_chambre_prg',
        'chambre_prg',
        'prix_achat_prg',
        'prix_vente_prg',
        'prix_prg',
        'FK_programme',
        'bnr_chambre',
        'Genre',
        'Totale_place',
        'Totale_place_reserver',
        'Fk_chambre',
    ];
    
    
    protected $dates = ['deleted_at'];
}
