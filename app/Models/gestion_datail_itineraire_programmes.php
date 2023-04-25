<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_datail_itineraire_programmes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_datail_itineraire_programmes';
    protected $fillable = ['date_retour_Itineraire','ville_Itineraire','Transport_Itineraire','itineraire_programme'];

    protected $dates=['deleted_at'];
}
