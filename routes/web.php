<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $dataProduct = Product::get();
    return view('admin.product', compact('dataProduct'));
});