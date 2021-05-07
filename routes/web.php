<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;    
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->middleware('auth');
Route::get('/users/create', [App\Http\Controllers\UsersController::class, 'create'])->middleware('auth');
Route::post('/users', [App\Http\Controllers\UsersController::class, 'store'])->middleware('auth');
Route::get('/users/{user}/edit',[App\Http\Controllers\UsersController::class, 'edit'])->middleware('auth'); 
Route::match(['put','patch'], '/users/{user}', [App\Http\Controllers\UsersController::class, 'update'])->middleware('auth');  
Route::delete('users/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->middleware('auth');
Route::get('/users/{id}/passwordEdit', [App\Http\Controllers\UsersController::class, 'passwordEdit'])->middleware('auth');
Route::post('/users/passwordUpda', [App\Http\Controllers\UsersController::class, 'passwordUpda'])->middleware('auth');
Route::get('/list/createList', [App\Http\Controllers\PriceListController::class, 'create'])->middleware('auth');
Route::post('/lists', [App\Http\Controllers\PriceListController::class, 'store'])->middleware('auth');
Route::get('/lists', [App\Http\Controllers\PriceListController::class, 'index'])->middleware('auth');
Route::get('/lists/{id}/edit', [App\Http\Controllers\PriceListController::class, 'edit'])->middleware('auth');
Route::match(['put','patch'], '/lists/{list}', [App\Http\Controllers\PriceListController::class, 'update'])->middleware('auth'); 
Route::delete('lists/{id}', [App\Http\Controllers\PriceListController::class, 'destroy'])->middleware('auth');
Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'index'])->middleware('auth');
Route::get('/products/create/{id}', [App\Http\Controllers\ProductsController::class, 'create'])->middleware('auth');
Route::post('/products', [App\Http\Controllers\ProductsController::class, 'store'])->middleware('auth');
Route::get('/products/{id}/edit', [App\Http\Controllers\ProductsController::class, 'edit'])->middleware('auth');
Route::match(['put','patch'], '/products/{product}', [App\Http\Controllers\ProductsController::class, 'update'])->middleware('auth'); 
Route::delete('products/{product}', [App\Http\Controllers\ProductsController::class, 'destroy'])->middleware('auth');
Route::get('/distributors', [App\Http\Controllers\ProductsController::class, 'productsDistriIron'])->middleware('auth');
Route::get('/ironmongers', [App\Http\Controllers\ProductsController::class, 'productsDistriIron'])->middleware('auth'); 
Route::get('exportProducts/{id}', [App\Http\Controllers\ProductsController::class, 'export'])->middleware('auth'); 
Route::get('/chooseList', [App\Http\Controllers\ProductsController::class, 'chooseList'])->middleware('auth');      
Route::post('importProducts/{id}', [App\Http\Controllers\ProductsController::class, 'import'])->middleware('auth');  
Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'index'])->middleware('auth');
Route::post('/orderProducts', [App\Http\Controllers\OrderProductsController::class, 'trolley'])->middleware('auth');  
Route::post('/bill', [App\Http\Controllers\OrderProductsController::class, 'bill'])->name('bill');
Route::get('/showOrders', [App\Http\Controllers\OrderProductsController::class, 'showOrder'])->middleware('auth');  
Route::get('/detailOrder', [App\Http\Controllers\OrderProductsController::class, 'detailOrder'])->middleware('auth');  
Route::post('/changeStatus', [App\Http\Controllers\OrderProductsController::class, 'changeStatus'])->middleware('auth'); 
Route::get('/myOrders', [App\Http\Controllers\OrderProductsController::class, 'myOrders'])->middleware('auth');    