<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\ShipmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;

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

        $totalToPay = $totalAmountToPay + '8000';

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

        if($requestAmount > $product->amountAvailable){
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
        $totalToPay = ($product->price * $requestAmount) + '8000';

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
}
