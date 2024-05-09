<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageProdController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\OrderController;

// Rutas de Usuario
Route::controller(UserController::class)->group(function(){
    // Home de la pagina
    Route::get('/', 'index')->name('pageHome');

    // Login de Usuarios
    Route::get('/login', 'login')->name('pageLogin');

    // Register de Usuarios
    Route::get('/register', 'register')->name('register');

    // Perfil del Usuario
    Route::get('/perfil', 'perfil')->name('pagePerfil')->middleware('auth');

    // Información personal del usuario
    Route::get('/perfil/my-information', 'myInformation')->name('pageInfo')->middleware('auth');

    // Información personal del usuario: Formulario
    Route::get('/perfil/my-information/create', 'myInformationCreate')->name('pageInfoF')->middleware('auth');

    // Información personal del usuario: Guardar Formulario 
    Route::post('/perfil/my-information/save', 'myInformationSave')->name('saveInfo')->middleware('auth');

    // Información de la cuenta: Formulario
    Route::get('/perfil/my-account/direcctions', 'myAccountCreate')->name('pageAccountF')->middleware('auth');
});

// Rutas de Productos
Route::controller(ProductController::class)->group(function(){
    // Pagina de Categorias, lista de productos
    Route::get('/category', 'index')->name('pageCategory');

    // Pagina de Categorias filtradas
    Route::get('/category/{brand}', 'filterByBrand')->name('pageCategoryFilter');

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
    Route::get('/cart/buy', 'buyProducts')->name('comprarCart')->middleware('auth');

    // Comprar producto escogido
    Route::post('/cart/purchase', 'purchaseProduct')->name('purchaseP')->middleware('auth');
});

Route::controller(ShipmentController::class)->group(function(){
    // Formulario para añadir una dirección
    Route::get('/perfil/my-account/direcctions/create', 'create')->name('createAddress');
    
    // Formulario para modificar una dirección
    Route::get('/perfil/my-account/direcctions/edit/{id}', 'edit')->name('editAddress');
    
    // Modificar una dirección
    Route::patch('/perfil/my-account/direcctions/update/{id}', 'update')->name('updateAddress');

    // Remover una dirección
    Route::delete('/perfil/my-account/direcctions/remove/{id}', 'remove')->name('removeAddress');

    // Guardar la direccion
    Route::post('/perfil/my-account/direcctions/save', 'store')->name('saveAddress');
});

Route::controller(OrderController::class)->group(function(){
    // Compras del Usuario
    Route::get('/perfil/my-shopping', 'myShopping')->name('pageShopping')->middleware('auth');
});

Auth::routes();