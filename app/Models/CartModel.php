<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'idUser',
        'idProduct',
        'amount'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function product() {
        return $this->belongsTo(ProductModel::class, 'idProduct', 'id');
    }
}
