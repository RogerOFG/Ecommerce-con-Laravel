<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\DashboardModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\User;
use App\Models\ShipmentModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalProductsSales = OrderModel::where('state', 2)->sum('amount');
        $totalUsers = User::count();

        $totalSales = OrderModel::where('state', 2)
            ->join('products', 'order.idProduct', '=', 'products.id')
            ->sum(DB::raw('order.amount * products.price'));

        return view('dashboard.dashboard', [
            'totalSales' => $totalSales,
            'totalProSales' => $totalProductsSales,
            'totalUsers' => $totalUsers
        ]);
    }

    public function dashboardUsers(){
        $fechaA = date('Y-m-d');

        $totalUsers = User::count();
        $totalUsersDay = User::whereDate('created_at', $fechaA)->count();
        $totalAdmins = User::where('admin', 1)->count();

        $users = User::latest()->paginate(10);

        return view('dashboard.users', [
            'totalUsers' => $totalUsers,
            'totalUsersDay' => $totalUsersDay,
            'totalAdmins' => $totalAdmins,
            'users' => $users
        ]);
    }

    public function dashboardUsersA($id){
        $user = User::where('id', $id)->first();
        $addresses = ShipmentModel::where('idUser', $id)->get();

        return view('dashboard.usersAddress', [
            'user' => $user,
            'addresses' => $addresses
        ]);
    }

    public function dashboardProd(){
        $totalProd = ProductModel::count();
        $stock = ProductModel::sum('amountAvailable');
        $totalProductsSales = OrderModel::where('state', 2)->sum('amount');

        $products = ProductModel::latest()->paginate(10)->onEachSide(1);

        return view('dashboard.products', [
            'totalProd' => $totalProd,
            'stock' => $stock,
            'totalPS' => $totalProductsSales,
            'products' => $products
        ]);
    }

    public function dashboardOrders(){
        $fechaA = date('Y-m-d');

        $totalOrders = OrderModel::count();
        $totalOrdersToday = OrderModel::whereDate('created_at', $fechaA)->count();
        $totalOrdersCanceled = OrderModel::where('state', 0)->count();
        $totalOrdersInProcess = OrderModel::where('state', 1)->count();
        $totalOrdersInWay = OrderModel::where('state', 2)->count();

        $orders = OrderModel::latest()->get();
        
        foreach ($orders as $order) {
            $idUser = $order->idUser;
            $idProd = $order->idProduct;

            $user = User::where('id', $idUser)->first();
            $prod = ProductModel::where('id', $idProd)->first();

            $order->user = $user;
            $order->prod = $prod;
        }

        return view('dashboard.orders', [
            'totalOrders' => $totalOrders,
            'totalOrdersT' => $totalOrdersToday,
            'totalOrdersC' => $totalOrdersCanceled,
            'totalOrdersP' => $totalOrdersInProcess,
            'totalOrdersW' => $totalOrdersInWay,
            'orders' => $orders
        ]);
    }

    public function dashboardSeeOrder($id){
        $order = OrderModel::where('id', $id)->first();

        $idUser = $order->idUser;
        $idProd = $order->idProduct;
        $idAddress = $order->idAddress;

        $user = User::where('id', $idUser)->first();
        $prod = ProductModel::where('id', $idProd)->first();
        $address = ShipmentModel::where('id', $idAddress)->first(); 

        $order->user = $user;
        $order->prod = $prod;
        $order->add = $address;

        return view('dashboard.seeOrder', [
            'order' => $order
        ]);
    }
}
