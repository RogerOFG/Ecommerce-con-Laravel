<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function myShopping(){
        $orders = OrderModel::where('idUser', auth()->id())->get();

        foreach ($orders as $order) {
            $image = $order->images()->first();
            $order->img = $image;

            $product = ProductModel::find($order->idProduct);
            $order->prod = $product;
        }

        return view('user.shopping', ['orders' => $orders]);
    }
}
