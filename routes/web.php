<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('/product/add', [ProductController::class, 'addProduct']);
Route::get('/product/add', [ProductController::class, 'showAddPage']);


Route::get('/product', [ProductController::class, 'showlistPage']);

Route::get('/product/list', [ProductController::class, 'showProductList']); 
Route::get('/product/detail-product', [ProductController::class, 'detailProduct']);

Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');


Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    return view('welcome');
});

Route::delete('/delete-produk/{id}', [ProductController::class, 'deleteProduct']);