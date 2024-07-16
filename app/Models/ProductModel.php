<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name', 'category', 'bisuteria_hilo', 'bisuteria_piedras', 'bisuteria_dijen', 'bisuteria_cierre', 'brand', 'price', 'cristal', 'caja', 'pulsera', 
        'manecillas', 'metrosAgua', 'garanty', 'amountAvailable'
    ];

    public function images(){
        return $this->hasMany(ImageProdModel::class, 'idProduct', 'id');
    }

    public function order(){
        return $this->hasMany(OrderModel::class, 'idProduct', 'id');
    }
}
