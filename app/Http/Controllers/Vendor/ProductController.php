<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category');
        $categories = Category::all();
        $products = Product::where('vendor_id', Auth::user()->vendor->id)
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->with('category')
            ->paginate(10);

        return view('vendor.products', compact('products', 'categories', 'category'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('vendor.add-product', compact('categories')); // Separate view for adding products
    }

    public function store(Request $request)
    {
        $vendor = Auth::user()->vendor;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'after_sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,draft', // Vendors can only set pending or draft
            'description' => 'required|string',
            'colors' => 'nullable|array',
            'sizes' => 'nullable|array',
            'image' => 'required|image|max:20048',
            'gallery.*' => 'nullable|image|max:20048',
            'warranty' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);

        $sku = 'SKU-' . strtoupper(Str::random(4)) . '-' . time();
        while (Product::where('sku', $sku)->exists()) {
            $sku = 'SKU-' . strtoupper(Str::random(4)) . '-' . time();
        }

        $imagePath = $request->file('image')->store('products', 'public');
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('products', 'public');
            }
        }

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'sku' => $sku,
            'price' => $validated['price'],
            'after_sale_price' => $validated['after_sale_price'] ?? null,
            'stock' => $validated['stock'],
            'description' => $validated['description'],
            'colors' => $validated['colors'] ? json_encode($validated['colors']) : null,
            'sizes' => $validated['sizes'] ? json_encode($validated['sizes']) : null,
            'image' => $imagePath,
            'gallery' => $galleryPaths ? json_encode($galleryPaths) : null,
            'warranty' => $validated['warranty'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'status' => $validated['status'],
        ]);

        return redirect()->route('vendor.products')->with('success', 'Product added successfully!');
    }

    public function quickView($id)
    {
        $product = Product::where('vendor_id', Auth::user()->vendor->id)
            ->findOrFail($id);
        return view('popup.quickView', compact('product'));
    }
}