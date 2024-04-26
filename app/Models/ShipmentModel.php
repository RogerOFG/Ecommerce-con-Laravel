<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentModel extends Model
{
    use HasFactory;

    protected $table = 'shipment_info';

    public function user(){
        return $this->belongsTo(User::class, 'ididUser', 'id');
    }
}
