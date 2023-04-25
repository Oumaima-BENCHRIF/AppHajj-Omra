<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;


class Compagnies extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'compagnies';
    protected $fillable = ['code_cie', 'compagnie', 'telephone', 'fax', 'adresse', 'directeur', 'tel_directeur', 'nom_en_arabe', 'compte_comptable_BSP', 'compte_comptable_normal'];

    protected $dates=['deleted_at'];
}
