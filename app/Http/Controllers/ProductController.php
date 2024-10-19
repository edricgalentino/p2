<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
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

        $product->stock = $request->stock;
        $product->year = $request->year_created;
        $product->condition = $request->condition;

        $product->save();
        return redirect('/product');
    }

    public function editProductView($id): View
    {
        $product = Product::find($id);
        return view('admin.producteditpage', compact('product'));
    }

    public function editProduct(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile(key: 'photos')) {
            $imagePth = $request->file(key: 'photos')->store('images', 'public');

            //delete old image
            Storage::disk('public')->delete($product->image);
        } else {
            $imagePth = $product->image;
        }
        $product->image = $imagePth;

        $product->stock = $request->stock;
        $product->year = $request->year_created;
        $product->condition = $request->condition;

        $product->save();
        return redirect('/product/list');
    }

    public function deleteProduct($id): \Illuminate\Http\RedirectResponse
    {
        $product = Product::find($id);
        Storage::disk('public')->delete($product->image);
        $product->delete();
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

    public function detailProduct($id): View
    {
        $dataProduct = Product::find($id);
        return view('admin.detailproduct', compact('dataProduct'));
    }
}