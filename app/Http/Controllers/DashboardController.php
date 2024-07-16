<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\DashboardModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\User;
use App\Models\ShipmentModel;
use App\Models\BillModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $fechaA = date('Y-m-d');

        $totalProductsSales = OrderModel::where('state', 3)->sum('amount');
        $totalUsers = User::count();

        $totalSales = OrderModel::where('state', 3)
            ->join('products', 'order.idProduct', '=', 'products.id')
            ->sum(DB::raw('order.amount * products.price'));

        $ordersToday = OrderModel::whereDate('created_at', $fechaA)->get();

        foreach ($ordersToday as $order){
            $userO = User::where('id', $order->idUser)->first();
            $order->user = $userO;

            $prodO = ProductModel::where('id', $order->idProduct)->first();
            $order->prod = $prodO;

            $totalPagoP = $order->amount * $order->prod->price;

            $order->total = $totalPagoP;
        }

        return view('dashboard.dashboard', [
            'totalSales' => $totalSales,
            'totalProSales' => $totalProductsSales,
            'totalUsers' => $totalUsers,
            'ordersToday' => $ordersToday
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
        $totalOrdersInProcess = OrderModel::where('state', 1)->count();
        $totalOrdersInWay = OrderModel::where('state', 2)->count();
        $totalOrdersFinished = OrderModel::where('state', 3)->count();
        $totalOrdersCanceled = OrderModel::where('state', 0)->count();

        $bills = BillModel::latest()->get();
        $orders = OrderModel::latest()->get();

        foreach ($bills as $item){
            $idUser = $item->idUser;
            $user = User::where('id', $idUser)->first();
            $item->user = $user;

            $ordersBill = OrderModel::where('idBill', $item->idBill)->get();
            $amount = 0;
            $subtotal = 0;

            // Inicializar contadores de estados
            $stateCounts = [
                'P' => 0, // En proceso
                'W' => 0, // En Camino
                'D' => 0, // Entregado
                'C' => 0  // Cancelado
            ];

            // Recorremos cada pedido perteneciente a cada factura
            foreach ($ordersBill as $order){
                // Estado General del pedido
                switch ($order->state) {
                    case 1:
                        $stateCounts['P']++;
                        break;
                    case 2:
                        $stateCounts['W']++;
                        break;
                    case 3:
                        $stateCounts['D']++;
                        break;
                    case 0:
                        $stateCounts['C']++;
                        break;
                }

                $idProd = $order->idProduct;
                $prod = ProductModel::where('id', $idProd)->first();

                $amount = $order->amount;
                $price = $prod->price;

                $subtotal += ($amount * $price);
            }

            // Definir estado general por prioridad
            if ($stateCounts['P'] >= 1) {
                $stateG = 1;
            } elseif ($stateCounts['W'] >= 1) {
                $stateG = 2;
            } elseif ($stateCounts['D'] >= 1) {
                $stateG = 3;
            } else {
                $stateG = 0;
            }

            $totalToPay = $subtotal;

            if($item->discount != "NULL"){
                $discount = $subtotal * ($item->discount / 100);
                $totalToPay = $subtotal - $discount;
            }

            // Almacenamos en la factura la informacion recolectada
            $item->state = $stateG;
            $item->subtotal = $subtotal;
            $item->coupon = $item->discount;
            $item->totalToPay = $totalToPay;
        }

        return view('dashboard.orders', [
            'bills' => $bills,
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'totalOrdersT' => $totalOrdersToday,
            'totalOrdersP' => $totalOrdersInProcess,
            'totalOrdersW' => $totalOrdersInWay,
            'totalOrdersF' => $totalOrdersFinished,
            'totalOrdersC' => $totalOrdersCanceled,
            'orders' => $orders
        ]);
    }

    public function dashboardSeeOrder($id){
        $bill = billModel::where('idBill', $id)->first();

        $idUser = $bill->idUser;
        $orders =   OrderModel::where('idBill', $bill->idBill)->get();
        $subtotal = 0;
        $products = [];

        // Inicializar contadores de estados
        $stateCounts = [
            'P' => 0, // En proceso
            'W' => 0, // En Camino
            'D' => 0, // Entregado
            'C' => 0  // Cancelado
        ];

        foreach ($orders as $i => $order){
            // Estado General del pedido
            switch ($order->state) {
                case 1:
                    $stateCounts['P']++;
                    break;
                case 2:
                    $stateCounts['W']++;
                    break;
                case 3:
                    $stateCounts['D']++;
                    break;
                case 0:
                    $stateCounts['C']++;
                    break;
            }

            $idAddress = $order->idAddress;

            $prod = ProductModel::where('id', $order->idProduct)->first();
            $products[$i] = $prod;

            if($order->state != 0){
                $amount = $order->amount;
                $price = $prod->price;

                $subtotal += $amount * $price;
            }
        }

        // Definir estado general por prioridad
        if ($stateCounts['P'] >= 1) {
            $stateG = 1;
        } elseif ($stateCounts['W'] >= 1) {
            $stateG = 2;
        } elseif ($stateCounts['D'] >= 1) {
            $stateG = 3;
        } else {
            $stateG = 0;
        }

        $totalToPay = $subtotal;

        if($bill->discount != "NULL"){
            $discount = $subtotal * ($bill->discount / 100);
            $totalToPay = $subtotal - $discount;
        }

        $user = User::where('id', $idUser)->first();
        $address = ShipmentModel::where('id', $idAddress)->first(); 

        $bill->state = $stateG;
        $bill->user = $user;
        $bill->add = $address;
        $bill->subtotal = $subtotal;
        $bill->total = $totalToPay;

        if ($bill->discount != "NULL"){
            $bill->discount = $bill->discount."%";
        }else{
            $bill->discount = "N/A";
        }

        return view('dashboard.seeOrder', [
            'bill' => $bill,
            'orders' => $orders,
            'prods' => $products
        ]);
    }

    public function dashboardChangeOrder(Request $request, $id){
        $orders = OrderModel::where('idBill', $id)
            ->where('state', '!=', 0)
            ->get();

        $state = 0;

        foreach ($orders as $order){
            if ($order->state != 0) {
                $product = ProductModel::where('id', $order->idProduct)->first();

                $state = $request->input('state');
                $amount = $order->amount;
                $newAmount = $product->amountAvailable + $amount;

                if ($state == 0) {
                    $product->update(['amountAvailable' => $newAmount]);
                }

                $order->update(['state' => $state]);
            }else{
                $state++;
            }
        }

        if ($state == 0){
            return redirect()->route('pageDashO')->with('error', 'El pedido ya ha sido cancelado ('.$id.') ');
        }

        return redirect()->route('pageDashO')->with('success', 'Estado cambiado correctamente ('.$id.')');
    }
}
