<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsageModel extends Model
{
    use HasFactory;

    protected $table = 'coupon_usage';

    protected $fillable = [
        'idCoupon',
        'idBill',
        'idUser',
    ];

    public function coupon() {
        return $this->belongsTo(CouponModel::class, 'id');
    }
}
