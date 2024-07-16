<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartModel;
use App\Models\BillModel;
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

                $bills = BillModel::get();
                $totalBillsInProcess = 0;

                foreach ($bills as $bill){
                    $ordersBill = OrderModel::where('idBill', $bill->idBill)
                        ->where('state', 1)
                        ->get();

                    if ($ordersBill->count() > 0) {
                        $totalBillsInProcess++;
                    }
                }

                $view->with([
                    'cartItems' => $cartItems,
                    'totalAmount' => $totalAmount,
                    'totalBillsP' => $totalBillsInProcess,
                    'userName' => $userName
                ]);
            }
        });
    }
}
