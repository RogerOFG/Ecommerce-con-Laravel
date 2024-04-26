<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.header', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();

                $totalAmount = CartModel::where('idUser', $userId)->sum('amount');

                $cartItems = CartModel::with('product', 'product.images')->where('idUser', $userId)->get();

                $view->with([
                    'cartItems' => $cartItems,
                    'totalAmount' => $totalAmount
                ]);
            }
        });
    }
}
