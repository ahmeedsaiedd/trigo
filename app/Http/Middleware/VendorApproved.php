<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorApproved
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->hasRole('Vendor') && $user->status !== 'approved') {
            return redirect()->route('home')->with('message', 'Your account is pending approval.');
        }

        return $next($request);
    }
}