<?php

namespace App\Http\Controllers;

// use App\Models\userModel;
use App\Models\User;
use App\Models\ShipmentModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('home');
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

    public function myShopping(){
        return view('user.shopping');
    }
}
