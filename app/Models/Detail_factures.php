<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Detail_factures extends Model
{
    use HasFactory;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'detail_factures';
    protected $fillable = [
    'nom_complet',
    'prix',
    'FK_Facture', 
   ];

    protected $dates=['deleted_at'];    
}
