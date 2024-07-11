<?php

namespace App\Http\Controllers;

// use App\Models\userModel;
use App\Models\User;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\ShipmentModel;
use App\Models\BillModel;
use App\Models\CouponModel;
use App\Models\CouponUsageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('home');
    }

    public function legal(){
        return view('privacyPolicies.legal');
    }

    public function policies(){
        return view('privacyPolicies.policies');
    }

    public function perfil(){
        $user = User::where('id', auth()->id())->get();

        return view('user.perfil', compact('user'));
    }

    public function myInformation(){
        return view('user.info');
    }

    public function myInformationCreate(){
        $user = User::where('id', auth()->id())->get();

        return view('user.infoForm', compact('user'));
    }

    public function myInformationSave(Request $request){
        $validate = $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string',
            'numCC' => 'required|int'
        ]);

        $rName = $request->input('name');
        $rSurname = $request->input('surname');
        $rCC = $request->input('numCC');

        $user = User::find(auth()->id());

        if ($user){
            $user->update([
                'name' => $rName,
                'surname' => $rSurname,
                'numCC' => $rCC
            ]);

            return back()->with('success', 'Información actualizada correctamente');
        }

    }

    public function myAccountCreate(){
        $shipments = ShipmentModel::where('idUser', auth()->id())->get();

        return view('user.account', compact('shipments'));
    }

    public function registerAdmin(){
        return view('dashboard.registerAdmin');
    }

    public function saveAdmin(Request $request){
        $validate = $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::insert([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'admin' => $request->input('admin'),
        ]);

        return redirect()->route('pageDashU')->with('success', 'Aministrador Registrado');
    }

    public function changeOrder(Request $request, $id){
        $order = OrderModel::where('id', $id)->first();
        $idBill = $order->idBill;

        if ($order->state != 0) {
            $product = ProductModel::where('id', $order->idProduct)->first();

            $state = $request->input('state');
            $amount = $request->input('amount');
            $newAmount = $product->amountAvailable + $amount;

            if ($state == 0) {
                $product->update(['amountAvailable' => $newAmount]);
            }

            $order->update(['state' => $state]);

            $orderBillState = OrderModel::where('idBill', $idBill)->get('state');
            $sw = false;

            // Buscamos si aun queda algun pedido de la misma factura que no este cancelado
            foreach ($orderBillState as $item ){
                $item;
                if ($item->state != 0){
                    $sw = true;
                }
            }

            if(!$sw){
                $couponUsage = CouponUsageModel::where('idBill', $idBill)->first();

                if($couponUsage){
                    $idCoupon = $couponUsage->idCoupon; 

                    $coupon = CouponModel::where('id', $idCoupon)->first();

                    // Devolvemos el cupon usado y eliminamos el uso del cupon
                    if($coupon){
                        $coupon->decrement('amountUsage');
                        $couponUsage->delete();

                        // Quitamos registros de uso del cupon en la factura
                        $bill = BillModel::where('idBill', $idBill)->first();
                        $bill->update(['discount' => "NULL"]);
                    }
                }
            }

            return back()->with('success', 'Has cancelado tu pedido correctamente');
        }
        return back()->with('error', 'Este pedido ya ha sido cancelada');
    }
}
