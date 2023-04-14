<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Hotel_transports extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'hotel_transports';
    protected $fillable = ['code', 'nom', 'FK_ville', 'emplacement', 'telephone', 'fax', 'site', 'compte_comptable_ramadan', 'compte_comptable_mouloud', 'contact', 'email', 'categorie', 'nom_en_arabe', 'FK_type'];

    protected $dates=['deleted_at'];
}
