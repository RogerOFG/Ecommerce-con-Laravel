<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageProdController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

Route::middleware('admin')->group(function () {
    Route::controller(DashboardController::class)->group(function(){
        // Dashboard: Inicio
        Route::get('/dashboard', 'index')->name('pageDash');

        // Dashboard: Usuarios
        Route::get('/dashboard/users', 'dashboardUsers')->name('pageDashU');

        // Dashboard: Usuarios Direcciones
        Route::post('/dashboard/users/{id}/address', 'dashboardUsersA')->name('pageDashUA');

        // Dashboard: Productos
        Route::get('/dashboard/products', 'dashboardProd')->name('pageDashP')->middleware('auth');

        // Dashboard: Pedidos
        Route::get('/dashboard/orders', 'dashboardOrders')->name('pageDashO');

        // Dashboard: Pedido Detallado
        Route::post('/dashboard/order/{id}', 'dashboardSeeOrder')->name('pageDashOS');

        // Dashboard: Modificar estado del pedido
        Route::post('/dashboard/order/{id}/state', 'dashboardChangeOrder')->name('pageDashOC');
    });

    Route::controller(ProductController::class)->group(function(){
        // Formulario de Registro de Producto
        Route::get('/dashboard/products/create', 'create')->name('pageCreateP');

        // Guardar Registro de Producto
        Route::post('/dashboard/products/save', 'store')->name('pageSaveP');

        // Formulario Actualizar Información de Producto
        Route::get('/dashboard/product/{id}/update', 'edit')->name('pageUpdateP');

        // Guardar los Cambios del Producto 
        Route::patch('/dashboard/product/{id}/update/save', 'update')->name('pageUpdateS');

        // Eliminar Producto
        Route::delete('dashboard/product/{id}/delete', 'delete')->name('deleteProd');
    });

    Route::controller(ImageProdController::class)->group(function(){
        // Formulario subida de Imagenes de Productos
        Route::get('/dashboard/images/{id}', 'index')->name('pageImagesP');

        // Guardar Imagenes de Producto
        Route::post('/dashboard/upload/{id}', 'upload')->name('pageUploadP');

        // Ver Imagenes de Producto
        Route::post('/dashboard/product/{id}/data', 'images')->name('pageShowI');

        // Eliminar Imagen de Producto
        Route::delete('/dashboard/product/{id}/image/{url}/delete', 'delete')->name('deleteImage');
    });

    Route::controller(UserController::class)->group(function(){
        // Formulario de registro de Admins
        Route::get('/dashboard/register/admin', 'registerAdmin')->name('registerAdmin');

        // Guardar formulario de registro de Admins
        Route::post('/dashboard/register/admin/save', 'saveAdmin')->name('saveAdmin');
    });
});

// Rutas de Usuario
Route::controller(UserController::class)->group(function(){
    // Home de la pagina
    Route::get('/', 'index')->name('pageHome');

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

    // Dashboard: Modificar estado del pedido
    Route::post('/perfil/my-shopping/{id}/state', 'changeOrder')->name('changeState');
});

// Rutas de Productos
Route::controller(ProductController::class)->group(function(){
    // Pagina de Categorias, lista de productos
    Route::get('/category', 'index')->name('pageCategory');

    // Pagina de Categorias filtradas
    Route::get('/category/{brand}', 'filterByBrand')->name('pageCategoryFilter');

    // Ver producto seleccionado
    Route::get('/product/{id}', 'showProduct')->name('pageProduct');
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

    // Informe de la compra
    Route::post('/bill', 'billPurchase')->name('finishP')->middleware('auth');

    Route::get('/bill/view', 'billView')->name('billView')->middleware('auth');
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