<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\User;

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        
    }

    public function boot() {
        View::composer(['layouts.header', 'layouts.base', 'layouts.dash'], function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                $userName = User::where('id', $userId)->value('name');

                $cartItems = CartModel::with('product', 'product.images')
                    ->where('idUser', $userId)
                    ->get();

                $totalAmount = $cartItems->sum('amount');

                $totalOrdersInProcess = OrderModel::where('state', 1)->count();

                $view->with([
                    'cartItems' => $cartItems,
                    'totalAmount' => $totalAmount,
                    'totalOrdersP' => $totalOrdersInProcess,
                    'userName' => $userName
                ]);
            }
        });
    }
}
