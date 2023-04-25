<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'sites';
    protected $fillable = ['name', 'abbreviation', 'server_url', 'db_name', 'user_db', 'password_db'];

    use HasFactory;
}
