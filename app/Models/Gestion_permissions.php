<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gestion_permissions extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $id = 'id';
    protected $table = 'gestion_permission';
    protected $fillable = ['nom_permission'];

    protected $dates=['deleted_at'];
}
