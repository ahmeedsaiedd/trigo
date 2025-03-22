<?php

namespace App\Http\Controllers;

use App\Models\Coupon; // Assuming you have a Coupon model
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Show the form for creating a new coupon.
     */
    public function create()
    {
        return view('vendor.add-coupon');
    }

    /**
     * Store a newly created coupon in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date|after:today',
        ]);

        Coupon::create([
            'code' => $request->code,
            'discount' => $request->discount,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('vendor.coupons.create')->with('success', 'Coupon created successfully!');
    }
}