<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fiche_client extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'fiche_clients';
    protected $fillable = ['compte', 'nom', 'adresse', 'C_postal', 'contact_commercial', 'telephone_commercial', 'mobile_commercial', 'ville_client', 'tele_client', 'email_client', 'pays_client', 'fax_client', 'marge_client', 'Remarques'];


    protected $dates=['deleted_at'];
}
