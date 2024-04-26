<?php

namespace App\Http\Controllers;

use App\Models\ShipmentModel;
<<<<<<< HEAD
use App\Models\User;
=======
>>>>>>> da6e634 (changes)
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
<<<<<<< HEAD
    // Hello World
    public function create(){
        $userData =  User::findOrFail(auth()->id());

        return view('address', compact('userData')); 
    }

    public function store(Request $request){
        $validate = $this->validate($request, [
            'department' => 'required|string',
            'address' => 'required',
            'city' => 'required|string',
            'district' => 'required|string',
            'phone' => 'required',
            'info' => 'required'
        ]);

        $shipmentData = request()->except('_token', 'name', 'surname');

        ShipmentModel::insert($shipmentData);

        return redirect()->route('pageAccountF')->with('success', 'Dirección añadida correctamente');
    }

    public function edit(ShipmentModel $shipmentModel, $id){
        $address = ShipmentModel::where('idUser', auth()->id())->findOrFail($id);

        return view('addressUpdate', compact('address'));
    }

    public function update(Request $request, $id){
        $validate = $this->validate($request, [
            'department' => 'required|string',
            'address' => 'required',
            'city' => 'required|string',
            'district' => 'required|string',
            'phone' => 'required',
            'info' => 'required'
        ]);

        $shipmentData = request()->except((['_token', '_method']));

        ShipmentModel::where('id', $id)->update($shipmentData);

        return redirect()->route('pageAccountF')->with('success', 'Dirección modificada correctamente');
    }

    public function remove($id){
        ShipmentModel::findOrFail($id)->delete();

        return redirect()->route('pageAccountF')->with('success', 'Elemento eliminado correctamente.');
=======
    public function create()
    {
        return view('address');
    }

    public function store(Request $request)
    {
        
    }

    public function show(ShipmentModel $shipmentModel)
    {
        
    }

    public function edit(ShipmentModel $shipmentModel)
    {
        
    }

    public function update(Request $request, ShipmentModel $shipmentModel)
    {
        
    }

    public function destroy(ShipmentModel $shipmentModel)
    {
        
>>>>>>> da6e634 (changes)
    }
}
