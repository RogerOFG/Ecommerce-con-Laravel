<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OrderModel;
use App\Models\BillModel;
use App\Models\CouponModel;
use App\Models\CouponUsageModel;
use App\Models\ProductModel;
use App\Models\ShipmentModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function myShopping(){
        $bills = BillModel::where('idUser', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();
        $orders = OrderModel::where('idUser', auth()->id())
        ->orderBy('state', 'desc')
        ->get();

        foreach ($orders as $order) {
            $image = $order->images()->first();
            $order->img = $image;

            $product = ProductModel::find($order->idProduct);
            $order->prod = $product;
        }

        return view('user.shopping', [
            'bills' => $bills,
            'orders' => $orders
        ]);
    }

    public function myBill($idBill){
        $bill = BillModel::where('idBill', $idBill)->first();
        $user = User::where('id', $bill->idUser)->first();
        $orders = OrderModel::where('idBill', $bill->idBill)->get();

        $productsArray = [];
        $stateProd = [];

        // Inicializar contadores de estados
        $stateCounts = [
            'P' => 0, // En proceso
            'W' => 0, // En Camino
            'D' => 0, // Entregado
            'C' => 0  // Cancelado
        ];

        // Buscamos y guardamos los productos en un array
        foreach ($orders as $i => $order){
            $productsArray[$i] = ProductModel::where('id', $order->idProduct)->first();
            $stateProd[$i] = $order->state;

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

            // Guardamos el id de la direccion de envio seleccionada (siempre es el mismo para cada orden)
            $idAddress = $order->idAddress;
        }

        // Definir estado general por prioridad
        if ($stateCounts['P'] >= 1) {
            $stateG = "En proceso";
        } elseif ($stateCounts['W'] >= 1) {
            $stateG = "En Camino";
        } elseif ($stateCounts['D'] >= 1) {
            $stateG = "Entregado";
        } else {
            $stateG = "Cancelado";
        }

        // Buscamos la direccion escogida
        $address = ShipmentModel::where('id', $idAddress)->first();

        $subTotal = 0;

        // Calculamos el Subtotal
        foreach ($productsArray as $i => $prod){
            if ($stateProd[$i] != 0){
                $subTotal += $orders[$i]->amount * $prod->price;
            }
        }

        // Total a pagar
        $totalToPay = $subTotal;

        // Calculamos el descuento si uso un cupon
        if($bill->discount != "NULL"){
            $discount = $subTotal * ($bill->discount / 100);
            $totalToPay = $subTotal - $discount;
        }

        return view('user.viewBill', [
            'user' => $user,
            'address' => $address,
            'orders' => $orders,
            'bill' => $bill,
            'subTotal' => $subTotal,
            'totalToPay' => $totalToPay,
            'products' => $productsArray,
            'state' => $stateG,
            'stateProd' => $stateProd
        ]);
    }

    public function cancelBill($idBill){
        $orders = OrderModel::where('idBill', $idBill)->get();
        $bill = BillModel::where('idBill', $idBill)->first();

        // Quitamos evidencia de uso del cupon de descuento (si es que hubo uno)
        if ($bill){
            $bill->update(['discount' => "NULL"]);
        }

        // Elinamos registro del uso del cupon (si fue asi)
        $couponUsage = CouponUsageModel::where('idBill', $idBill)->first();

        if($couponUsage){
            //Devolvemos el cupon eliminado
            $coupon = CouponModel::where('id', $couponUsage->idCoupon)->first();

            if ($coupon){
                $coupon->decrement('amountUsage');
            }

            $couponUsage->delete();
        }


        foreach ($orders as $item){
            // Cancelamos los pedidos de la factura
            if ($item->state != 0){
                $item->update(['state' => 0]);

                // Hacemos la busqueda individual de cada producto
                $prod = ProductModel::find($item->idProduct);
                
                // Devolvemos los productos al Stock
                if ($prod){
                    $currentAmount = $prod->amountAvailable;
                    $orderAmount = $item->amount;
    
                    $newAmount = $currentAmount + $orderAmount;
    
                    $prod->update(['amountAvailable' => $newAmount]);
                }
            }
        }

        return redirect()->route('pageShopping')->with('success', 'El pedido se ha cancelado correctamente');
    }
}
