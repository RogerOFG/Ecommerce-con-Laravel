<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\CouponModel;
use App\Models\CouponUsageModel;
use App\Models\BillModel;
use App\Models\ShipmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Cart;

class CartController extends Controller
{
    public function index(){
        $cartItems = CartModel::where('idUser', auth()->id())->with('product', 'product.images')->get();
        $subTotal = 0;
        $products = [];

        foreach ($cartItems as $i => $item){
            $prod = ProductModel::where('id', $item->idProduct)->first();

            if ($prod){
                $products[] = $prod->price;
                $subTotal = $subTotal + ($item->amount * $products[$i]);
            }
        }

        return view('cart')->with('cartItems', $cartItems)->with('subTotal', $subTotal);
    }

    public function buyProducts(){
        $transactionToken = Str::random(40);

        // Almacena el token en la sesión
        Session::put('transactionToken', $transactionToken);
        
        $userData =  User::findOrFail(auth()->id());
        $cartItems = CartModel::where('idUser', auth()->id())->with('product', 'product.images', 'user.shipmentData')->get();

        $totalAmountToPay = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->amount;
        });

        $totalAmount = $cartItems->sum(function ($cartItem) {
            return $amount = $cartItem->amount;
        });

        $totalToPay = $totalAmountToPay;

        return view('compra', [
            'transactionToken' => $transactionToken,
            'cartItems' => $cartItems,
            'totalProducts' => $totalAmountToPay,
            'totalToPay' => $totalToPay,
            'userData' => $userData,
            'amount' => $totalAmount
        ]);
    }

    public function purchaseProduct(Request $request){
        $transactionToken = Str::random(40);

        // Almacena el token en la sesión
        Session::put('transactionToken', $transactionToken);

        $requestID = $request->input('idProduct');
        $requestAmount = $request->input('amount', 1);

        $userData =  User::findOrFail(auth()->id());
        $product = ProductModel::findOrFail($requestID);

        if($product->amountAvailable <= 0){
            return back()->with('error', 'El producto se encuentra sin existencias en el momento');
        }else if($requestAmount > $product->amountAvailable){
            return back()->with('error', 'La cantidad seleccionada no puede ser superior a la disponible');
        }

        $existingCartItem = CartModel::where('idUser', auth()->id())
        ->where('idProduct', $requestID)
        ->first();

        if (!$existingCartItem) {
            CartModel::create([
                'idUser' => auth()->id(),
                'idProduct' => $requestID,
                'amount' => $requestAmount,
            ]);
        }

        $cartItem = CartModel::where([
            ['idUser', auth()->id()],
            ['idProduct', $requestID]
        ])->with('product', 'product.images', 'user.shipmentData')->get();

        $productTotal = ($product->price * $requestAmount);
        $totalToPay = ($product->price * $requestAmount);

        return view('compra', [
            'transactionToken' => $transactionToken,
            'cartItems' => $cartItem,
            'amountTotal' => $requestAmount,
            'totalProducts' => $productTotal,
            'totalToPay' => $totalToPay,
            'userData' => $userData
        ]);
    }

    public function addToCart(Request $request, $id){
        $product = ProductModel::findOrFail($id);

        $requestedAmount = $request->input('amount', 1);

        if ($requestedAmount > $product->amountAvailable) {
            return back()->with('error', 'La cantidad seleccionada no puede ser superior a la disponible');
        }

        $existingCartItem = CartModel::where('idUser', auth()->id())
        ->where('idProduct', $id)
        ->first();

        if ($existingCartItem) {
            $newAmount = $existingCartItem->amount + $requestedAmount;

            if($newAmount > $product->amountAvailable){
                return back()->with('error', 'La cantidad seleccionada no puede ser superior a la disponible');
            }

            $existingCartItem->update(['amount' => $newAmount]);
        } else {
            CartModel::create([
                'idUser' => auth()->id(),
                'idProduct' => $id,
                'amount' => $request->input('amount', 1),
            ]);
        }

        return back()->with('success', 'Producto agregado al carrito');
    }

    public function removeToCart($itemId){
        CartModel::findOrFail($itemId)->delete();

        return back()->with('success', 'Producto eliminado del carrito');
    }

    public function updateCartItem(Request $request, $id){
        $cart = CartModel::findOrFail($id);
        $product = ProductModel::findOrFail($cart->idProduct);

        $rAmount = $request->input('amount');

        if($rAmount > $product->amountAvailable){
            return back()->with('error', 'La cantidad seleccionada no puede ser superior a la disponible');
        }

        $existingCartItem = CartModel::where('idUser', auth()->id())
        ->where('idProduct', $product->id)
        ->first();

        if ($existingCartItem) {
            $existingCartItem->update(['amount' => $rAmount]);
        }

        return back();
    }

    public function billPurchase(Request $request){
        $sessionToken = Session::get('transactionToken');
        $requestToken = $request->get('transactionToken');

        // Verificamos si el token de la sesión coincide con el token de la solicitud
        if ($sessionToken !== $requestToken) {
            return redirect()->route('pageCart')->with('error', 'Transacción inválida. Por favor, realiza la compra nuevamente.');
        }

        Session::forget('transactionToken');

        $request->validate([
            'idAddress' => 'required|exists:shipment_info,id',
            'items' => 'required|array',
        ]);

        $addressData = ShipmentModel::findOrFail($request->input('idAddress'))->toArray();
        $products = $request->input('items');
        $prodsArray = [];
        $orderArray = [];

        foreach ($products as $item) {
            $decodedItem = json_decode($item, true);
            $prodData = ProductModel::find($decodedItem['id']);

            if ($prodData) {
                $prodsArray[] = $prodData->toArray();
                $amount = $decodedItem['amount'];
                $stock = $prodData->amountAvailable;

                // Validamos si la cantidad solicitada está en stock
                if ($amount <= $stock) {
                    // Creamos el registro de la compra
                    $order = OrderModel::create([
                        'idBill' => auth()->id(),
                        'idProduct' => $prodData->id,
                        'idUser' => auth()->id(),
                        'idAddress' => $addressData['id'],
                        'state' => 1,
                        'amount' => $decodedItem['amount'],
                    ]);

                    $orderArray[] = $order->toArray();

                    // Actualizamos el nuevo monto en stock
                    $prodData->update(['amountAvailable' => $stock - $amount]);

                    $existingCartItem = CartModel::where('idUser', auth()->id())
                        ->where('idProduct', $prodData->id)
                        ->first();

                    // Eliminamos / Restamos items del carrito del usuario
                    if ($existingCartItem) {
                        $amountC = $existingCartItem->amount;
                        $newCartAmount = $amountC - $amount;

                        if ($newCartAmount <= 0) {
                            $existingCartItem->delete();
                        } else {
                            $existingCartItem->update(['amount' => $newCartAmount]);
                        }
                    }
                } else {
                    return redirect()->route('pageCart')->with('error', 'Disminuye la cantidad de productos, que no supere la cantidad disponible.');
                }
            }else{
                return redirect()->route('pageCart')->with('error', 'Ha ocurrido un error con alguno de los productos, intente de nuevo.');
            }
        }

        // Validamos la existencia del cupon usado (si fue asi)
        $discount = CouponModel::where('code', $request->get('code'))->first();

        if (!$discount) {
            $discountValue = "NULL";
        } else {
            $discount->increment('amountUsage');

            $couponUsage = CouponUsageModel::create([
                'idCoupon' => $discount->id,
                'idUser' => auth()->id()
            ]);

            $discountValue = $discount->discount;
        }

        // Creamos el registro de la factura
        $bill = BillModel::create([
            'idUser' => auth()->id(),
            'discount' => $discountValue
        ]);

        // Modificamos el idBill del cupon creado
        if($discount){
            $couponUsage->update(['idBill' => $bill->idBill]);
        }

        // Le añadimos el id generado de la factura a cada uno de los elementos
        foreach ($orderArray as $item){
            $idOrder = $item['id'];
            $existingItem = OrderModel::where('id', $idOrder)->first();

            if ($existingItem) {
                $existingItem->update(['idBill' => $bill->idBill]);
            }
        }

        // Obtenemos fecha actual
        $currentDate = Carbon::now();

        Session::put('discount', $discountValue);
        Session::put('bill', $bill);
        Session::put('orders', $orderArray);
        Session::put('currentDate', $currentDate);
        Session::put('address', $addressData);
        Session::put('products', $prodsArray);

        return redirect()->route('billView');
    }

    public function billView(){
        $discount = Session::get('discount');
        $bill = Session::get('bill');
        $ordersArray = Session::get('orders');
        $currentDate = Session::get('currentDate');
        $addressData = Session::get('address');
        $productsArray = Session::get('products');

        $user = User::find(auth()->id());

        // Convertimos los arrays de productos y pedidos de nuevo a objetos
        $products = collect($productsArray)->map(function ($item) {
            return (object) $item;
        });

        $orders = collect($ordersArray)->map(function ($item) {
            return (object) $item;
        });

        $subTotal = 0;

        foreach ($products as $i => $prod){
            $subTotal += $orders[$i]->amount * $prod->price;
        }

        $totalToPay = $subTotal;

        if($bill->discount != "NULL"){
            $discount = $subTotal * ($bill->discount / 100);
            $totalToPay = $subTotal - $discount;
        }

        // Obtenemos el ID de la factura recien creada
        $billId = $bill->idBill;

        return view('bill', [
            'orderId' => $billId,
            'user' => (object) $user,
            'currentDate' => $currentDate,
            'subTotal' => $subTotal,
            'totalToPay' => $totalToPay,
            'orders' => $orders,
            'bill' => $bill,
            'address' => (object) $addressData,
            'products' => $products
        ]);
    }
}
