<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentModel extends Model
{
    use HasFactory;

    protected $table = 'shipment_info';

<<<<<<< HEAD
    protected $fillable = [
        'idUser',
        'numCC',
        'city'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'idUser', 'id');
=======
    public function user(){
        return $this->belongsTo(User::class, 'ididUser', 'id');
>>>>>>> da6e634 (changes)
    }
}
