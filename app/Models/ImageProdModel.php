<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProdModel extends Model
{
    use HasFactory;

    protected $table = 'product_image';
    protected $fillable = ['idProduct', 'url'];

    public function product(){
        return $this->belongsTo(ProductModel::class, 'idProduct', 'id');
    }
}
