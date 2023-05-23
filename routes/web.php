<?php

use App\Http\Controllers\AdminOrder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CustomerOrder;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return redirect('/home');

});
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/register', [RegisterController::class, 'registerCustomer'])->name('register');

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['guest']);
// Route::get('/welcome', function () {
//     return view('welcome');
// });
Route::get('/home', function () {
    return view('pages.home');
})->name('host');
Route::get('/', function () {
    return view('pages.market');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// For products
Route::group(['prefix' => 'product'], function() {
    Route::controller(ProductController::class)->group(function () {
        Route::get('data', 'index')->name('products');
        Route::get('create', 'create')->name('create-product');
        Route::post('create', 'store');
        Route::get('{product}/show', 'show')->name('show-product');
        Route::get('{product}/edit', 'edit')->name('edit-product');
        Route::put('{product}/edit', 'update');
        Route::delete('{product}/delete','destroy')->name('delete-product');
        Route::get('products-export', 'export')->name('products.export');
        Route::post('products-import', 'import')->name('products.import');
    });
});

// For Product Categories
Route::group(['prefix' => 'product-category'], function() {
    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('data', 'index')->name('categories');
        Route::get('create', 'create')->name('create-category');
        Route::post('create', 'store');
        Route::get('{productCategory}/show', 'show')->name('show-category');
        Route::get('{productCategory}/edit', 'edit')->name('edit-category');
        Route::put('{productCategory}/edit', 'update');
        Route::delete('{productCategory}/delete','destroy')->name('delete-category');
    });
});

Route::group(['prefix' => 'user'], function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('data', 'index')->name('users');
        Route::get('create', 'create')->name('create-user');
        Route::post('create', 'store');
        Route::get('{user}/show', 'show')->name('show-user');
        Route::get('{id}/edit', 'edit')->name('edit-user');
        Route::put('{id}/edit', 'update');
        Route::delete('{id}/delete','destroy')->name('delete-user');
        Route::get('{user}/assign-role', 'assign_roles')->name('assign-roles');
        Route::post('{user}/assign-role', 'assign_roles_store');
    });
});

// User Roles routes
Route::group(['prefix' => 'user/role'], function() {
    Route::controller(RoleController::class)->group(function () {
        Route::get('data', 'index')->name('roles');
        Route::get('create', 'create')->name('create-role');
        Route::post('create', 'store');
        Route::get('{role}/show', 'show')->name('show-role');
        Route::get('{role}/edit', 'edit')->name('edit-role');
        Route::put('{role}/edit', 'update');
        Route::delete('{role}/delete','destroy')->name('delete-role');
        Route::get('{role}/assign-permissions', 'assign_permissions')->name('assign-permissions');
        Route::post('{role}/assign-permissions', 'assign_permissions_store');
    });
});

// User Permission routes
Route::group(['prefix' => 'user/permission'], function() {
    Route::controller(PermissionController::class)->group(function () {
        Route::get('data', 'index')->name('permissions');
        Route::get('create', 'create')->name('create-permission');
        Route::post('create', 'store');
        Route::get('{permission}/edit', 'edit')->name('edit-permission');
        Route::put('{permission}/edit', 'update');
        Route::delete('{permission}/delete','destroy')->name('delete-permission');
    });
});

Route::group(['prefix' => 'setting'], function() {
    Route::controller(SettingController::class)->group(function () {
        Route::get('data', 'index')->name('settings');
        Route::put('update', 'update')->name('update-settings');
    });
});


//GUEST









Route::group(['prefix' => 'guest'], function() {
Route::controller(GuestController::class)->group(function () {
    Route::get('/searchProduct','searchProduct')->name(('search-product'));
    Route::get('/shop','shop')->name('shop');
    Route::get('/productDetail/{id}','productDetails');
    Route::get('/cartP', 'shopingCart');
    Route::post('/add-to-cart', 'addProductToCart');
    Route::post('/empty-cart', 'emptyCart')->name('empty-cart');
    Route::put('/edit-cart/{id}','updateProductQuantityInCart')->name('edit-cart');
    Route::delete('/delete-from-cart/{id}', 'deleteProductFromCart')->name('delete-product-cart');
    Route::get('/checkout','checkout');


});
});

Route::get('/', [HomeController::class, 'listProduct']);
Route::get('add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('add.to.cart');
Route::get('cart', [HomeController::class, 'cart'])->name('cart');
Route::patch('update-cart', [HomeController::class, 'updateCart'])->name('update.cart');
Route::delete('remove-from-cart', [HomeController::class, 'remove'])->name('remove.from.cart');

// Orders
Route::group(['prefix' => 'CustOrder'], function() {
Route::controller(CustomerOrder::class)->group(function () {
Route::get('/client/orders', 'order')->name('client-orders-show');
Route::post('/order','sendorder')->name('makeOrder');
Route::get('client/order/update/{id}','updateOrder')->name('client-order-update');
Route::delete('client/order/{id}','cancelOrder')->name('client-order-cancel');
Route::delete('client/orderItem/{id}', 'cancelOrderItem')->name('client-orderItem-cancel');
});
});

Route::get('/order', [CustomerOrder::class, 'order'])->name('sendorder');
// Route::post('/order','sendorder')->name('makeOrder');
Route::get('/checkout', [GuestController::class, 'checkout'])->name('checkout');



// Order Admin
Route::group(['prefix' => 'AdminOrder'], function() {
    Route::controller(AdminOrder::class)->group(function () {
    Route::get('/admin/orders', 'order')->name('orders');
    Route::get('admin/order/update/{id}', 'updateOrder')->name('update-orders');
    Route::put('admin/order/edit/{id}','editOrderStatus')->name('manage-status');
    });
    });


