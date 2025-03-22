<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function show($brandName)
{
    $brandData = Brand::where('name', $brandName)->firstOrFail();

    // Fetch products belonging to this brand
    $products = Product::where('brand_id', $brandData->id)->where('status', 'active')->get();

    return view('brands.show', compact('brandData', 'products'));

        $brandData = Brand::findOrFail($id);
        $products = Product::where('brand_id', $brandData->id)->get();

        return view('brand.show', compact('brandData', 'products'));
    }
}

