<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Optionally redirect or abort if unauthorized
        return abort(403, 'Unauthorized action.');
    }
}

