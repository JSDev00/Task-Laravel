<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...

        Route::get('/', [ProductController::class,'show'])->name('start');

        //-------------------------Product Route --------------------------------//
        Route::post('/products',[ProductController::class,'store'])->name('products');
        Route::get('/Allproducts',[ProductController::class,'index'])->name('Allproducts');
        Route::post('/deleteProduct/{id}',[ProductController::class,'destroy'])->name('deleteProduct');
        Route::post('/updateProduct/{id}',[ProductController::class,'update'])->name('updateProduct');
        Route::get('/search',[ProductController::class,'search'])->name('search');
        Route::get('/print_pdf/{id}',[ProductController::class,'print'])->name('print_pdf');

        //-------------------------Category Route --------------------------------//
        Route::get('/category',[CategoryController::class,'index'])->name('category');
        Route::post('/Addcategory',[CategoryController::class,'store'])->name('Addcategory');
    });









