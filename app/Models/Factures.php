<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Database\Eloquent\SoftDeletes;

class Factures extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'factures';
    protected $fillable = [
    'Code_client',
    'numero_facture',
    'Numero_dossier', 
    'bon_commande', 
    'date', 
    'Vos_ref', 
    'Nom_client', 
    'adresse', 
    'ville', 
    'Total',
    'fk_fiche'];

    protected $dates=['deleted_at'];
    
    public function reglement()
    {
        return $this->belongsToMany(Reglement::class);
    }
}
