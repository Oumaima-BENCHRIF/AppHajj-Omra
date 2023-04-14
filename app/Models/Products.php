<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $connection = 'mysql_portal';
    protected $table = 'products';
    protected $fillable = ['name', 'product', 'pedigree', 'site_id', 'base'];

    public function Sites()
    {
        return $this->belongsTo(Sites::class, 'site_id', 'id');
    }

}
