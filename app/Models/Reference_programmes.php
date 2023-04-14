<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reference_programmes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'reference_programmes';
    protected $fillable = ['N_programme', 'nom_programme', 'type', 'nbre_nuitees', 'ref_programme', 'compagnie', 'transfert'];


    protected $dates=['deleted_at'];
}
