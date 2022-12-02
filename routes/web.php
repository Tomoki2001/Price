<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Controller;
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
Route::get('products/rakuten',[ProductController::class,'get_rakuten_items'])->middleware(['auth'])->name('products.rakuten');
Route::get('products/serch',[ProductController::class,'serch_rakuten_items'])->middleware(['auth'])->name('products.serch');
Route::get('products/product',[ProductController::class,'index'])->middleware(['auth'])->name('products.product');
Route::get('products/create',[ProductController::class,'create'])->middleware(['auth'])->name('products.create');
Route::post('products/store',[ProductController::class,'store'])->middleware(['auth'])->name('products.store');
Route::get('products/edit/{product}',[ProductController::class,'edit'])->middleware(['auth'])->name('products.edit');
Route::put('products/create/{product}',[ProductController::class,'update'])->middleware(['auth'])->name('products.update');
Route::get('products/{product}',[ProductController::class,'destroy'])->middleware(['auth'])->name('products.destroy');
Route::delete('products/{product}',[ProductController::class,'destroy'])->middleware(['auth'])->name('products.destroy');




Route::get('/dashboard', function ()
    {
       return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
