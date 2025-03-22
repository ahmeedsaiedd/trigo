<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();
        return view('admin.products', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.add-product', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0|max:999999.99',
                'after_sale_price' => 'nullable|numeric|min:0|max:999999.99',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|in:active,rejected,draft,pending',
                'description' => 'required|string|max:5000',
                'colors' => 'nullable|array',
                'sizes' => 'nullable|array',
                'warranty' => 'nullable|integer|min:0',
                'is_featured' => 'nullable|boolean',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:20048',
                'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Generate unique SKU
            $sku = 'SKU-' . strtoupper(Str::random(4)) . '-' . time();
            while (Product::where('sku', $sku)->exists()) {
                $sku = 'SKU-' . strtoupper(Str::random(4)) . '-' . time();
            }

            $path = null;
            if ($request->hasFile('image')) {
                $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                $path = $request->file('image')->storeAs('products', $filename, 'public');
            }

            $product = Product::create([
                'name' => $validated['name'],
                'sku' => $sku,  // Auto-generated SKU
                'price' => $validated['price'],
                'after_sale_price' => $validated['after_sale_price'] ?? null,
                'stock' => $validated['stock'],
                'category_id' => $validated['category_id'],
                'status' => $validated['status'],
                'description' => $validated['description'],
                'colors' => json_encode($validated['colors'] ?? []),
                'sizes' => json_encode($validated['sizes'] ?? []),
                'warranty' => $validated['warranty'] ?? null,
                'is_featured' => $validated['is_featured'] ?? false,
                'vendor_id' => auth()->user()->vendor_id ?? null,
                'created_by' => auth()->id() ?? null,
                'image' => $path
            ]);

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('products/' . $product->id, $filename, 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'is_primary' => false,
                    ]);
                }
            }

            Log::info('Product created successfully', [
                'product_id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('admin.products')->with('success', 'Product added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Product creation error', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Failed to add product')->withInput();
        }
    }
}