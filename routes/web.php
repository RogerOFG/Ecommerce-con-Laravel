<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageProdController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShipmentController;

// Rutas de Usuario
Route::controller(UserController::class)->group(function(){
    // Home de la pagina
    Route::get('/', 'index')->name('pageHome');

    // Login de Usuarios
    Route::get('/login', 'login')->name('pageLogin');

    // Register de Usuarios
    Route::get('/register', 'register')->name('register');
});

// Rutas de Productos
Route::controller(ProductController::class)->group(function(){
    // Pagina de Categorias, lista de productos
    Route::get('/category', 'index')->name('pageCategory');

    // Ver producto seleccionado
    Route::get('/product/{id}', 'showProduct')->name('pageProduct');

    // Formulario de Registro de Producto
    Route::get('/dashboard/create', 'create')->name('pageCreateP')->middleware('auth');

    // Guardar Registro de Producto
    Route::post('/dashboard/save', 'store')->name('pageSaveP');
});

// Rutas de Imegenes de los Productos
Route::controller(ImageProdController::class)->group(function(){
    // Formulario subida de Imagenes de Productos
    Route::get('/dashboard/images/{id}', 'index')->name('pageImagesP');
    
    // Guardar Imagenes de Producto
    Route::post('/dashboard/upload/{id}', 'upload')->name('pageUploadP');
});

// Rutas del Carrito de Compras
Route::controller(CartController::class)->group(function(){
    // Home de la pagina
    Route::get('/cart', 'index')->name('pageCart');

    // Añadir productos al Carrito
    Route::post('/cart/add/{id}', 'addToCart')->name('cartAdd');

    // Remover productos del Carrito
    Route::delete('/cart/remove/{itemId}', 'removeToCart')->name('cartRemove');

    // Aumentar o Disminuir la cantidad de productos del Carrito
    Route::patch('/cart/update/{itemId}', 'updateCartItem')->name('updateCart');

    // Comprar productos del productos del Carrito
    Route::get('/cart/comprar', 'pageCompra')->name('comprarCart')->middleware('auth');
});

Route::controller(ShipmentController::class)->group(function(){
    // Formulario para añadir una dirección
    Route::get('/address/create', 'create')->name('createAddress');

    // Guardar Registro de Producto
    Route::post('/address/save/', 'store')->name('saveAddress');
});

Auth::routes();