<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('/product/add', [ProductController::class, 'addProduct']);
Route::get('/product/add', [ProductController::class, 'showAddPage']);

Route::patch('/product/{id}/edit', [ProductController::class, 'editProduct']);
Route::get('/product/{id}/edit', [ProductController::class, 'editProductView']);

Route::delete('/product/{id}/delete', [ProductController::class, 'deleteProduct']);

Route::get('/product', [ProductController::class, 'showlistPage']);
Route::get('/product/list', [ProductController::class, 'showProductList']);

Route::get('/app', function () {
    return view('layouts.app');
});
Route::get('/', function () {
    return view('welcome');
});
