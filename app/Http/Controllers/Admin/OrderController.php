<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders'); // Ensure this view exists
    }
    public function pending()
    {
        return view('admin.orders.pending'); // Ensure this view exists
    }
}
