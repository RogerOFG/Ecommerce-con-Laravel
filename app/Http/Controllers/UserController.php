<?php

namespace App\Http\Controllers;

// use App\Models\userModel;
use App\Models\User;
use App\Models\ShipmentModel;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index(){
        return view('home');
    }

    public function perfil(){
        return view('user.perfil');
    }

    public function myInformation(){
        return view('user.info');
    }

    public function myInformationCreate(){
        return view('user.infoForm');
    }

    public function myInformationSave(Request $request){
        $validate = $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string',
            'numCC' => 'required'
        ]);

        $rName = $request->input('name');
        $rSurname = $request->input('surname');
        $rCC = $request->input('numCC');

        $user = User::find(auth()->id());
        $infoUser = ShipmentModel::where('idUser', auth()->id())->first() ;

        if ($user){
            $user->update([
                'name' => $rName,
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

            return back()->with('success', 'Información actualizada correctamente');
        }

    }

    public function myAccount(){
        return view('user.account');
    }

    public function myAccountCreate(){
        return view('user.accountForm');
    }

    public function myShopping(){
        return view('user.shopping');
    }
}
