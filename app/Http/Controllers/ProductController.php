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

        ProductModel::insert($productData);

        return back()->with('success', 'Producto Registrado');
    }

    public function show(ProductModel $productModel){
        
    }

    public function edit(ProductModel $productModel){
        
    }

    public function update(Request $request, ProductModel $productModel){
        
    }

    public function destroy(ProductModel $productModel){
        
    }
}
