<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_Allotement extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion__allotement';
    protected $fillable = [
        'num_allotement',
        'nom_allotement',
        'compagnie',
        'totale_accorde',
        'totale_occupe',
        'totale_reliquat',
        'vole_retours_id',
        'vole_departs_id '
    ];


    protected $dates = ['deleted_at'];
}
