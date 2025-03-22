<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is logged in
    }

    public function index()
{
    $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->paginate(10);
    $wishlistCount = $wishlistItems->count();

    dd($wishlistItems); // Debugging line
}


    public function remove($id)
    {
        $item = Wishlist::where('user_id', Auth::id())->findOrFail($id);
        $item->delete();

        return redirect()->route('home.wishlist')->with('success', 'Item removed from wishlist.');
    }
}