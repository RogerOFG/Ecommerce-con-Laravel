<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartModel;

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        
    }

    public function boot() {
        View::composer(['layouts.header', 'layouts.base'], function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                $cartItems = CartModel::with('product', 'product.images')
                    ->where('idUser', $userId)
                    ->get();

                $totalAmount = $cartItems->sum('amount');

                $view->with([
                    'cartItems' => $cartItems,
                    'totalAmount' => $totalAmount
                ]);
            }
        });
    }
}
