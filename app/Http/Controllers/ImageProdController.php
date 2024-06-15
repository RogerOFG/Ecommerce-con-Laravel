<?php

namespace App\Http\Controllers;

use App\Models\ImageProdModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageProdController extends Controller
{
    public function index($id){
        $prod = ProductModel::findOrFail($id);

        return view('dashboard.uploadPictures', compact('prod'));
    }

    public function upload(Request $request, $id){
        $request->validate([
            'url.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = ProductModel::findOrFail($id);

        $productFolderPath = public_path("public/img/products/{$id}");
        if (!file_exists($productFolderPath)) {
            mkdir($productFolderPath, 0777, true);
        }

        foreach ($request->file('url') as $imageFile) {
            $randomDigits = Str::random(4);
            $imageName = "{$id}-" . Str::slug($product->brand, '-') . "-{$randomDigits}.{$imageFile->extension()}";

            $imagePath = $imageFile->storeAs("public/img/products/{$id}", $imageName);

            $url = [
                'idProduct' => $id,
                'url' => $imageName,
            ];

            ImageProdModel::create($url);
        }

        return redirect()->route('pageDashP')->with('success', 'Imagen(es) subida(s) correctamente');
    }

    public function images($id){
        $product = ProductModel::where('id', $id)->first();
        $images = ImageProdModel::where('idProduct', $id)->get();

        return view('dashboard.imagesProduct', [
            'product' => $product,
            'images' => $images
        ]);
    }

    public function delete($id, $url){
        $product = ProductModel::find($id);

        if (!$product) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Eliminamos la imagen de la base de datos
        $product->images()->where('url', $url)->delete();

        // Eliminamos la imagen del almacenamiento
        $path = public_path('storage/img/products/' . $id . '/' . $url);

        if (file_exists($path)) {
            unlink($path);
            return redirect()->route('pageDashP')->with('success', 'Imagen eliminada correctamente');
        }

        return redirect()->route('pageDashP')->with('error', 'La imagen no existe');
    }
}
