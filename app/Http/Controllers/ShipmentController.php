<?php

namespace App\Http\Controllers;

use App\Models\ShipmentModel;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
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
        
    }
}
