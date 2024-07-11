<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BillModel extends Model
{
    use HasFactory;

    protected $table = 'bill'; 
    
    protected $fillable = [
        'idBill',
        'idUser',
        'discount'
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($bill) {
            $bill->idBill = self::generateCustomId(auth()->id());
        });
    }

    private static function generateCustomId($userId) {
        $date = now()->format('Ymd'); // Obtiene el año, mes y día actual
        $randomLetter1 = strtoupper(Str::random(1)); // Genera una letra aleatoria
        $randomLetter2 = strtoupper(Str::random(1)); // Genera otra letra aleatoria
        $randomNumbers = rand(100, 999); // Genera tres números aleatorios

        return $date . $randomLetter1 . $userId . $randomLetter2 . $randomNumbers;
    }
}
