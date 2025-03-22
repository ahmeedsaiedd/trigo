<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Example: Fetch cart items (adjust based on your cart implementation)
        $cartItems = []; // Replace with actual cart logic, e.g., session or database
        $cartCount = count($cartItems); // Example count

        return view('home.cart', compact('cartItems', 'cartCount'));
    }
}