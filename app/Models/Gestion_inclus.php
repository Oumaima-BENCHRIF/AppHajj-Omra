<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gestion_inclus extends Model
{
    use HasFactory;   
    use SoftDeletes;
    protected $connection = 'mysql_portal';
    protected $id = 'id';
    protected $table = 'gestion_inclus';
    protected $fillable = [
        'exclu_Billet',
        'Reduction_Billet',
        'Raison_Billet',

        'exclu_Transport',
        'Reduction_Transport',
        'Raison_Transport',
        
        
        'Reduction_Hotel_Meedina',
        'Raison_Hotel_Meedina',
        'exclu_Hotel_Makka',

        'exclu_Hotel_Makka',
        'Reduction_Hotel_Makka',
        'Raison_Hotel_Makka',

        'Reduction_Visa',
        'exclu_Visa',
        'Raison_Visa',
    ];

    protected $dates=['deleted_at'];
}
