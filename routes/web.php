<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user']], function () {

    Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
    Route::post('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product-page');
    Route::get('/pay/{id}', [App\Http\Controllers\HomeController::class, 'payment'])->name('pay');

    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::post('/success', [App\Http\Controllers\HomeController::class, 'success'])->name('success');
    Route::post('/fail', [App\Http\Controllers\HomeController::class, 'fail'])->name('fail');
    Route::get('/payment', [App\Http\Controllers\HomeController::class, 'payment'])->name('payment');
    Route::post('/payment', [App\Http\Controllers\HomeController::class, 'payment']);

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Route::get('/payment', [App\Http\Controllers\HomeController::class, 'payment']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'adminMiddleware']], function () {

    Route::get('/adminProduct', [App\Http\Controllers\HomeController::class, 'admin'])->name('adminProduct');
    Route::post('/adminProduct', [App\Http\Controllers\HomeController::class, 'admin'])->name('adminProduct-e');
    Route::get('/productEdit/{id}', [App\Http\Controllers\HomeController::class, 'productEdit'])->name('edit');
    Route::get('/createProduct', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
    Route::post('/add', [App\Http\Controllers\HomeController::class, 'productStore'])->name('add');
    Route::post('/adminProduct', [App\Http\Controllers\HomeController::class,'update'])->name('update');
    Route::get('/destroy/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('destroy');
    

});








// Route::get('/raad/{id}/edit', [empController::class, 'edit']);

