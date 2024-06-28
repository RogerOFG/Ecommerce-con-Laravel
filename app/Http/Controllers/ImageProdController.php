<?php

namespace App\Http\Controllers;

use App\Models\ImageProdModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageProdController extends Controller
{
    public function index($id){
        $prod = ProductModel::findOrFail($id);

        return view('dashboard.uploadPictures', compact('prod'));
    }

    public function upload(Request $request, $id) {
        // Validar la solicitud
        $request->validate([
            'url.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    
        // Obtener el producto por ID
        $product = ProductModel::findOrFail($id);
    
        // Definir la ruta de la carpeta donde se guardarán las imágenes
        $productFolderPath = "public/img/products/{$id}";
    
        // Crear el directorio si no existe usando Storage de Laravel
        Storage::makeDirectory($productFolderPath, 0775, true); // Permisos 0775
    
        // Iterar sobre cada archivo de imagen subido
        foreach ($request->file('url') as $imageFile) {
            // Generar un nombre único para la imagen
            $randomDigits = Str::random(4);
            $imageName = "{$id}-" . Str::slug($product->brand, '-') . "-{$randomDigits}.{$imageFile->extension()}";
    
            // Guardar la imagen en el almacenamiento de Laravel
            $imagePath = $imageFile->storeAs($productFolderPath, $imageName);
    
            // Guardar la URL de la imagen en la base de datos
            $url = [
                'idProduct' => $id,
                'url' => $imageName,
            ];
    
            ImageProdModel::create($url);
        }
        
        chmod(storage_path("app/{$productFolderPath}"), 0775);
    
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
