<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refund;

class RefundController extends Controller
{
    public function index()
    {
        $refunds = Refund::all(); // Fetch all refunds
        return view('admin.refund.index', compact('refunds')); // Ensure this view exists
    }
}
