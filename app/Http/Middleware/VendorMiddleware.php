<?php

namespace App\Http\Middleware;

use Closure;

class VendorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403);
        }

        if (!auth()->user()->isApprovedVendor()) {
            return redirect('/dashboard')
                ->with('error', 'Your vendor account is pending approval.');
        }

        return $next($request);
    }
}
    