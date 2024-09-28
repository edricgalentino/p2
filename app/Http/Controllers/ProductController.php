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

    public function addProduct(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'photos' => 'required'
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile(key: 'photos')) {
            $imagePth = $request->file(key: 'photos')->store('images', 'public');
        } else {
            return back()->with('error', 'No file selected');
        }
        $product->image = $imagePth;

        $product->save();
        return redirect('/product');
    }

    public function showlistPage(): View
    {
        $dataProduct = Product::get();
        return view('admin.productpage', compact('dataProduct'));
    }

    public function showProductList(): View
    {
        $dataProduct = Product::get();
        return view('admin.productlistpage', compact('dataProduct'));
    }
}