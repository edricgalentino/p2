<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function showAddPage(): View
    {
        $tags = Tag::all(); // Fetch all existing tags
        return view('admin.productaddpage', compact('tags'));
    }

    public function addProduct(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'photos' => 'required',
            'tags' => 'required|array'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->year = $request->year_created;
        $product->condition = $request->condition;

        if ($request->hasFile('photos')) {
            $product->image = $request->file('photos')[0]->store('images', 'public');
            $product->save();

            foreach ($request->file('photos') as $index => $photo) {
                $photoEntity = $product->photos()->create(['url' => $photo->store('images', 'public'), 'product_id' => $product->id]);

                $phototagIds = [];
                $photoTags = $request->input('tags-' . $index, []);
                foreach ($photoTags as $tag) {
                    // If it's a numeric tag, mean it's an id not a new tag it's an existing tag
                    if (is_numeric($tag)) {
                        $phototagIds[] = $tag;
                    } else {
                        // If it's not a numeric tag, it's a new tag name
                        $newTag = $this->tagService->createOrUpdateTags($tag);
                        $phototagIds[] = $newTag->id;
                    }
                    echo "Tag: " . $tag . PHP_EOL;
                }

                // Attach the tag IDs to the photo
                $photoEntity->tags()->sync($phototagIds);
            }

            $tagIds = [];
            foreach ($request->tags as $tag) {
                // If it's a numeric tag, mean it's an id not a new tag it's an existing tag
                if (is_numeric($tag)) {
                    $tagIds[] = $tag;
                } else {
                    // If it's not a numeric tag, it's a new tag name
                    $newTag = $this->tagService->createOrUpdateTags($tag);
                    $tagIds[] = $newTag->id;
                }
            }

            // Attach the tag IDs to the product without removing existing relations
            $product->tags()->sync($tagIds); // This will insert into the 'tags_products' table with the product_id and tag_id, don't ask me how it works, it's magic
        } else {
            return back()->with('error', 'No file selected');
        }

        return redirect('/product/list');
    }

    public function editProductView($id): View
    {
        $product = Product::find($id);
        $tags = Tag::all(); // Fetch all existing tags
        return view('admin.producteditpage', compact('product', 'tags'));
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

        if ($request->existing_photos != null && !$request->hasFile(key: 'photos')) {
            foreach ($product->photos as $index => $photo) {
                $phototagIds = [];
                $photoTags = $request->input('photo-' . $photo->id . '-tags', []);
                foreach ($photoTags as $tag) {
                    // If it's a numeric tag, mean it's an id not a new tag it's an existing tag
                    if (is_numeric($tag)) {
                        $phototagIds[] = $tag;
                    } else {
                        // If it's not a numeric tag, it's a new tag name
                        $newTag = $this->tagService->createOrUpdateTags($tag);
                        $phototagIds[] = $newTag->id;
                    }
                }

                // Attach the tag IDs to the photo
                $photo->tags()->sync($phototagIds);
            }
        } else if ($request->hasFile(key: 'photos')) {
            $product->image = $request->file('photos')[0]->store('images', 'public');
            foreach ($request->file('photos') as $index => $newphoto) {
                $photoEntity = $product->photos()->create(['url' => $newphoto->store('images', 'public'), 'product_id' => $product->id]);

                $phototagIds = [];
                $photoTags = $request->input('tags-' . $index, []);
                foreach ($photoTags as $tag) {
                    // If it's a numeric tag, mean it's an id not a new tag it's an existing tag
                    if (is_numeric($tag)) {
                        $phototagIds[] = $tag;
                    } else {
                        // If it's not a numeric tag, it's a new tag name
                        $newTag = $this->tagService->createOrUpdateTags($tag);
                        $phototagIds[] = $newTag->id;
                    }
                }

                // Attach the tag IDs to the photo
                $photoEntity->tags()->sync($phototagIds);
            }
        } else {
            return back()->withErrors(['error' => 'No file selected']);
        }

        $product->stock = $request->stock;
        $product->year = $request->year_created;
        $product->condition = $request->condition;

        $product->save();

        $tagIds = [];
        foreach ($request->tags as $tag) {
            // If it's a numeric tag, mean it's an id not a new tag it's an existing tag
            if (is_numeric($tag)) {
                $tagIds[] = $tag;
            } else {
                // If it's not a numeric tag, it's a new tag name
                $newTag = $this->tagService->createOrUpdateTags($tag);
                $tagIds[] = $newTag->id;
            }
        }

        // Attach the tag IDs to the product without removing existing relations
        $product->tags()->sync($tagIds); // This will insert into the 'tags_products' table with the product_id and tag_id, don't ask me how it works, it's magic

        return redirect()->route('product.list');
    }

    public function deleteProduct($id): \Illuminate\Http\RedirectResponse
    {
        $product = Product::find($id);
        Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect('/product/list');
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
        $product = Product::find($id);
        return view('admin.productdetailpage', compact('product'));
    }

    public function downloadImage($id)
    {
        $product = Product::find($id);
        $path = storage_path('app/public/' . $product->image);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
