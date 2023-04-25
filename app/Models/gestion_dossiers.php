<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gestion_dossiers extends Model
{
    use HasFactory;   
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_dossier';
    protected $fillable = ['nom_dossier','hijri_date', 'Date_debut','Date_fin'];

    protected $dates=['deleted_at'];
}
