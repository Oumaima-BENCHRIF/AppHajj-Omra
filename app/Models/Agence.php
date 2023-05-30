<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Agence extends Model
{
    use HasFactory;
    use SoftDeletes;
   
    protected $id = 'id';
    protected $table = 'agence';
}
