<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Hotels_programmes extends Model
{
    use HasFactory;
    
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'hotels_programmes';
    protected $fillable = ['code', 'nom_prenom', 'telephone', 'fax', 'adresse', 'prix'];

    protected $dates=['deleted_at'];
}
