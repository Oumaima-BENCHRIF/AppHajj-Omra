<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_datail_services_progs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_datail_services_prog';
    protected $fillable = [
        'Service',
        'villes',
        'hotel_fournisseur',
        'nbr_etoile',
        'FK_programme'];

    protected $dates=['deleted_at'];
}
