<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index(){
        $products = ProductModel::latest()->get();

        foreach ($products as $product) {
            $image = $product->images()->first();
            $product->image = $image;
        }

        return view('category', ['products' => $products]);
    }

    public function filterByBrand($brand){
        $products = ProductModel::where('brand', $brand)->get();

        foreach ($products as $product) {
            $image = $product->images()->first();
            $product->image = $image;
        }

        return view('category', ['products' => $products]);
    }

    public function showProduct($id){
        $product = ProductModel::findOrFail($id);

        $images = $product->images()->get();

        return view('product', compact('product', 'images'));
    }

    public function create(){
        return view('dashboard.create');
    }

    public function store(Request $request){
        $validate = $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'cristal' => 'required',
            'caja' => 'required',
            'pulsera' => 'required',
            'manecillas' => 'required',
            'metrosAgua' => 'required',
            'garanty' => 'required',
            'amountAvailable' => 'required'
        ]);

        $productData = request()->except('_token');

        $product = ProductModel::create($productData);

        return redirect()->route('pageImagesP', ['id' => $product->id])->with('success', 'Producto Registrado, añada las imagenes');
    }

    public function edit($id){
        $prod = ProductModel::where('id', $id)->first();

        return view('dashboard.updateProduct', compact('prod'));
    }

    public function update(Request $request, $id){
        $validate = $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'cristal' => 'required',
            'caja' => 'required',
            'pulsera' => 'required',
            'manecillas' => 'required',
            'metrosAgua' => 'required',
            'garanty' => 'required',
            'amountAvailable' => 'required'
        ]);

        if(!$validate){
            return redirect()->back()->with('error', 'Verifique todos los campos');
        }

        $productData = request()->except((['_token', '_method']));

        ProductModel::where('id', '=', $id)->update($productData);

        return redirect()->back()->with('success', 'Información Actualizada correctamente');
    }

    public function delete($id){
        ProductModel::destroy($id);

        return redirect()->route('pageDashP')->with('success', 'Producto eliminado correctamente');
    }
}
