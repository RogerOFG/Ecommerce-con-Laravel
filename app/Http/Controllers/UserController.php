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
<<<<<<< HEAD
        $user = User::where('id', auth()->id())->get();

        return view('user.perfil', compact('user'));
=======
        return view('user.perfil');
>>>>>>> fb40287 (a)
    }

    public function myInformation(){
        return view('user.info');
    }

    public function myInformationCreate(){
<<<<<<< HEAD
        $user = User::where('id', auth()->id())->get();

        return view('user.infoForm', compact('user'));
=======
        return view('user.infoForm');
>>>>>>> fb40287 (a)
    }

    public function myInformationSave(Request $request){
        $validate = $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string',
<<<<<<< HEAD
            'numCC' => 'required|int'
=======
            'numCC' => 'required'
>>>>>>> fb40287 (a)
        ]);

        $rName = $request->input('name');
        $rSurname = $request->input('surname');
        $rCC = $request->input('numCC');

        $user = User::find(auth()->id());
<<<<<<< HEAD
=======
        $infoUser = ShipmentModel::where('idUser', auth()->id())->first() ;
>>>>>>> fb40287 (a)

        if ($user){
            $user->update([
                'name' => $rName,
<<<<<<< HEAD
                'surname' => $rSurname,
                'numCC' => $rCC
            ]);

=======
                'surname' => $rSurname
            ]);

            if($infoUser){
                $infoUser->update(['numCC' => $rCC]);
            }else{
                ShipmentModel::create([
                    'idUser' => auth()->id(),
                    'numCC' => $rCC
                ]);
            }

>>>>>>> fb40287 (a)
            return back()->with('success', 'Información actualizada correctamente');
        }

    }

    public function myAccount(){
        return view('user.account');
    }

    public function myAccountCreate(){
<<<<<<< HEAD
        $shipments = ShipmentModel::where('idUser', auth()->id())->get();

        return view('user.account', compact('shipments'));
=======
        return view('user.accountForm');
>>>>>>> fb40287 (a)
    }

    public function myShopping(){
        return view('user.shopping');
    }
}
