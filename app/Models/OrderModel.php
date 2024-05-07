<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'order';

    public function product(){
        return $this->hasMany(ProductModel::class, 'idProduct', 'id');
    }

    public function user(){
        return $this->hasMany(User::class, 'idUser', 'id');
    }

    public function images(){
        return $this->hasMany(ImageProdModel::class, 'idProduct', 'idProduct');
    }
}
