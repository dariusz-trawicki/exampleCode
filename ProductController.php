<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        if (request('s')) {
            $products = Product::query();
            $products->when(request('s'), function ($query) {
                $query->where('name', 'like', '%' . request('s') . '%')
                    ->orWhere('description', 'like', '%' . request('s') . '%')
                    ->orderBy('name', 'asc');
            });
        } else {
            $products = Product::orderBy('name', 'asc');
        }
        return view('product.index', ['products' => $products->paginate(12, ['*'], 'str')]);
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
		
        $categories = Category::orderBy('name', 'asc')->get();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);

        $product = new Product([
            'name'=> $request->get('name'),
            'description'=> $request->get('description'),
            'category_id'=> $request->get('category_id')
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . request()->image->getClientOriginalExtension();
            $product->image = $fileName;
            $request->image->storeAs('public/images/products', $fileName);
        } else {
            $product->image = "brak.jpg";
        }

        $product->save();
        return redirect()->route('produkty.show', $product)->with('success', 'Nowy produkt  został utworzony.');
    }

     /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        $categories = Category::orderBy('name', 'asc')->get();
        return view('product.edit', compact('product','categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . request()->image->getClientOriginalExtension();
            $request->image->storeAs('public/images/products', $fileName);
            if ($product->image != 'brak.jpg') {
                Storage::delete('public/images/products/' . $product->image);
            }
            $product->image = $fileName;
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        $product->update();
        return redirect()->route('produkty.show', $product)->with('success', 'Produkt został nadpisany.');

    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        if (strcmp($product->image, 'brak.jpg')) {
            Storage::delete('public/images/products/' . $product->image);
        }
        $product->delete();

        return redirect()->route('produkty.index')
            ->with('success','Produkt został usunięty.');
    }
}
