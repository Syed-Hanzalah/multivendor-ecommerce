<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VendorApprovedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // must be vendor AND approved
        if (!$user || !$user->isApprovedVendor()) {
            abort(403, 'Vendor not approved yet.');
        }

        return $next($request);
    }
}
