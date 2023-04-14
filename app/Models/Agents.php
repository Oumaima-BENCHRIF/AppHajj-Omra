<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'agents';
    protected $fillable = ['code_agents', 'nom_agents', 'telephone', 'fax', 'adresse'];

    protected $dates=['deleted_at'];
}
