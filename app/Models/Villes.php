<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Villes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'villes';
    protected $fillable = ['nom'];
    protected $dates=['deleted_at'];
}
