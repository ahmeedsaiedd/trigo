<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        $totalUsers = User::count();
        return view('admin.dashboard', compact('totalUsers'));
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function editorDashboard()
    {
        return view('vendor.dashboard');
    }

    public function userHome(Request $request)
    {
        $categoryName = $request->input('category');

        $categories = Category::with(['products' => function ($query) use ($categoryName) {
            $query->where('status', 'active');
            if ($categoryName) {
                $query->whereHas('category', function ($subQuery) use ($categoryName) {
                    $subQuery->where('name', 'LIKE', ucfirst($categoryName));
                });
            }
        }])->get();

        $products = Product::when($categoryName, function ($query, $categoryName) {
            return $query->whereHas('category', function ($subQuery) use ($categoryName) {
                $subQuery->where('name', 'LIKE', ucfirst($categoryName));
            });
        })->with('category')->where('status', 'active')->get();

        $brands = Brand::all();

        return view('home.index', compact('categories', 'products', 'categoryName', 'brands'));
    }

    public function index()
    {
        $products = Product::where('status', 'active')->get();
        $users = User::where('role', 'vendor')
                     ->where('status', 'active')
                     ->whereNotNull('shop_logo')
                     ->get();
        $vendors = Vendor::where('status', 'approved')->get();
        $brands = Brand::all();

        return view('home.index', compact('products', 'vendors', 'users', 'brands'));
    }

    public function show($id)
    {
        $brandData = Brand::findOrFail($id);
        $products = Product::where('brand_id', $brandData->id)->get();

        \Log::info('Brand Data:', ['brand' => $brandData->toArray()]);
        \Log::info('Products:', ['products' => $products->toArray()]);

        return view('brand.show', compact('brandData', 'products'));
    }
}