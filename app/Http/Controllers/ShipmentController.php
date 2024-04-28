<?php

namespace App\Http\Controllers;

use App\Models\ShipmentModel;
use App\Models\User;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function create()
    {
        $userData =  User::findOrFail(auth()->id());

        return view('address', compact('userData')); 
    }

    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'name' => 'required|string',
            'surname' => 'required|string',
            'department' => 'required|string',
            'address' => 'required',
            'city' => 'required|string',
            'district' => 'required|string',
            'phone' => 'required',
            'info' => 'required'
        ]);

        $shipmentData = request()->except('_token', 'name', 'surname');

        ShipmentModel::insert($shipmentData);

        return back()->with('success', 'Dirección añadida correctamente');
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
        
    }
}
