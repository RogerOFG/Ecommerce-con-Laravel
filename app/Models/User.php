<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'numCC',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin() {
        return $this->admin === '1';
    }

    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function shipmentData(){
        return $this->hasMany(ShipmentModel::class, 'idUser', 'id');
    }

    public function order(){
        return $this->hasMany(OrderModel::class, 'idUser', 'id');
    }
}
