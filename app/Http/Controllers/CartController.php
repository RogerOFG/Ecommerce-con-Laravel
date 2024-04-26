<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> 7260ff1 (Subida de proyecto Laravel)
use App\Models\CartModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;

class CartController extends Controller
{
    public function index(){
        $cartItems = CartModel::where('idUser', auth()->id())->with('product', 'product.images')->get();

        return view('cart')->with('cartItems', $cartItems);
    }

    public function pageCompra(){
<<<<<<< HEAD
        $userData =  User::findOrFail(auth()->id());
        $cartItems = CartModel::where('idUser', auth()->id())->with('product', 'product.images', 'user.shipmentData')->get();
=======
        $cartItems = CartModel::where('idUser', auth()->id())->with('product', 'product.images')->get();
>>>>>>> 7260ff1 (Subida de proyecto Laravel)

        $totalAmountToPay = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->amount;
        });

        $totalToPay = $totalAmountToPay + '8000';

        return view('compra', [
            'cartItems' => $cartItems,
            'totalProducts' => $totalAmountToPay,
<<<<<<< HEAD
            'totalToPay' => $totalToPay,
            'userData' => $userData
=======
            'totalToPay' => $totalToPay
>>>>>>> 7260ff1 (Subida de proyecto Laravel)
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
<<<<<<< HEAD
        $product = ProductModel::findOrFail($cart->idProduct);

        $rAmount = $request->input('amount');

        if($rAmount > $product->amountAvailable){
=======
        $product = ProductModel::findOrFail($cart->idUser);

        $requestedAmount = $request->input('amount');

        if($requestedAmount > $product->amountAvailable){
>>>>>>> 7260ff1 (Subida de proyecto Laravel)
            return back()->with('error', 'La cantidad seleccionada no puede ser superior a la disponible');
        }

        $existingCartItem = CartModel::where('idUser', auth()->id())
        ->where('idProduct', $product->id)
        ->first();

        if ($existingCartItem) {
<<<<<<< HEAD
            $existingCartItem->update(['amount' => $rAmount]);
=======
            $existingCartItem->update(['amount' => $requestedAmount]);
>>>>>>> 7260ff1 (Subida de proyecto Laravel)
        }

        return back();
    }
}
