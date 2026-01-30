<?php

namespace App\Http\Controllers\Vendor;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products()->with('category')->get();
        return view('vendor.products.index', compact('products'));
    }

   public function create()
{
    // Get all parent categories with children
    $categories = \App\Models\Category::with('children')->whereNull('parent_id')->get();

    return view('vendor.products.create', compact('categories'));
}


   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validation
    ]);

    $data = $request->only('name', 'description', 'price', 'stock');

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $data['image'] = $imagePath;
    }

    auth()->user()->products()->create($data);

    return redirect()->route('vendor.products.index')
        ->with('success', 'Product added successfully');
}
public function edit(Product $product)
{
    if ($product->vendor_id !== auth()->id()) {
        abort(403);
    }

    $categories = \App\Models\Category::with('children')->whereNull('parent_id')->get();

    return view('vendor.products.edit', compact('product', 'categories'));
}

public function update(Request $request, Product $product)
{
    if ($product->vendor_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
         'category_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->only('name', 'description', 'price', 'stock','category_id');

    // Handle image update
    if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('vendor.products.index')
        ->with('success', 'Product updated successfully');
}

public function destroy(Product $product)
{
    if ($product->vendor_id !== auth()->id()) {
        abort(403);
    }

    // Delete image if exists
    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect()->route('vendor.products.index')
        ->with('success', 'Product deleted successfully');
}


}