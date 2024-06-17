<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\ShipmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        $cartItems = CartModel::where('idUser', auth()->id())->with('product', 'product.images')->get();

        return view('cart')->with('cartItems', $cartItems);
    }

    public function buyProducts(){
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
            'cartItems' => $cartItems,
            'totalProducts' => $totalAmountToPay,
            'totalToPay' => $totalToPay,
            'userData' => $userData,
            'amount' => $totalAmount
        ]);
    }

    public function purchaseProduct(Request $request){
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
        $request->validate([
            'idAddress' => 'required|exists:shipment_info,id',
            'items' => 'required|array',
        ]);

        $addressData = ShipmentModel::findOrFail($request->input('idAddress'));
        $products = $request->input('items');

        foreach($products as $item){
            $decodedItem = json_decode($item, true);
            $prodData = ProductModel::find($decodedItem['id']);

            if($prodData){
                $prodsArray[] = $prodData;
                $amount = $decodedItem['amount'];
                $stock = $prodData->amountAvailable;

                // Validamos si la cantidad solicitada esta en stock
                if($amount <= $stock){
                    // Creamos el registro de la compra
                    OrderModel::create([
                        'idProduct' => $prodData->id,
                        'idUser' => auth()->id(),
                        'idAddress' => $addressData->id,
                        'state' => 1,
                        'amount' => $decodedItem['amount'],
                    ]);

                    // actualizamos el nuevo monto en stock
                    $prodData->update(['amountAvailable' => $stock - $amount]);

                    $existingCartItem = CartModel::where('idUser', auth()->id())
                    ->where('idProduct', $prodData->id)
                    ->first();
                    
                    // Eliminamos / Restamos items del carrito del usuario
                    if($existingCartItem) {
                        $amountC = $existingCartItem->amount;
                        $newCartAmount = $amountC - $amount;

                        if($newCartAmount <= 0){
                            $existingCartItem->delete();
                        }else{
                            $existingCartItem->update(['amount' => $newCartAmount]);
                        }
                    }
                }else{
                    return redirect()->route('pageCart')->with('error', 'Disminuye la cantidad de productos, que no supere la cantidad disponible.');
                }
            }
        }

        Session::put('address', $addressData);
        Session::put('products', $prodsArray);

        return redirect()->route('billView');
    }

    public function billView(){
        $address = Session::get('address');
        $products = Session::get('products');
    
        return view('bill', [
            'address' => $address,
            'products' => $products
        ]);
    }
}
