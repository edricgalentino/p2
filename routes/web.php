<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PhotoController;


Route::get('/product', function () {
	return view('welcome');
});
Route::get('/product/list', [ProductController::class, 'showProductList'])->name('product.list');
Route::get('/product/detail/{id}', [ProductController::class, 'detailProduct']);

Route::get('/app', function () {
	return view('layouts.app');
});
Route::get('/', function () {
	return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('registerpage');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(function () {

	Route::get('/product/{id}/edit', [ProductController::class, 'editProductView']);
	Route::put('/product/{id}/edit', [ProductController::class, 'editProduct']);

	Route::delete('/product/{id}/delete', [ProductController::class, 'deleteProduct']);

	Route::get('/product/add', [ProductController::class, 'showAddPage']);
	Route::post('/product/add', [ProductController::class, 'addProduct']);

	Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

	Route::get('/product/download/{id}', [ProductController::class, 'downloadImage'])->name('downloadimage');

	Route::delete('/photo/{id}', [PhotoController::class, 'deletePhoto']);
});

Route::post('/tags/create', [TagController::class, 'createTag']);
