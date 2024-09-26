<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    //
    public function showAddPage(): View
    {
        return view('admin.productaddpage');
    }

    public function showlistPage(): View
    {
        $dataProduct = Product::get();
        return view('admin.productpage', compact('dataProduct'));
    }

    public function showProductList(): View
    {
        $dataProduct = Product::get();
        return view('admin.productlist', compact('dataProduct'));
    }
}
