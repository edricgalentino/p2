<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/product/add', [ProductController::class, 'showAddPage']);

Route::get('/product', [ProductController::class, 'showlistPage']);

Route::get('/product/list', [ProductController::class, 'showProductList']);

Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    return view('welcome');
});
