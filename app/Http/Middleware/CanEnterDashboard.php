<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanEnterDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role_name = Auth::user()->role->name;
        if ($role_name == 'admin' or $role_name == 'superadmin') {
            return $next($request);
        }
        return redirect(url("/"));
    }
}