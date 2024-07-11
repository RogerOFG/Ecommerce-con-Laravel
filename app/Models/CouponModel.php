<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponModel extends Model
{
    use HasFactory;

    protected $table = 'coupon'; 
    
    protected $fillable = [
        'code',
        'type',
        'idProduct',
        'idUser',
        'discount',
        'amountLimit',
        'amountUsage'
    ];

    public function usages() {
        return $this->hasMany(CouponUsageModel::class, 'id');
    }
}
