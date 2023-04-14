<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gestion_itineraires extends Model
{
    use HasFactory;   
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_itineraire';
    protected $fillable = ['nom_itineraire'];

    protected $dates=['deleted_at'];
}
