<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        if (Auth::user()->id_roles === Role::ADMIN_ROLE) {
            return $next($request);
        } else {
            return redirect('home')->with('error', "You don't have admin access.");
        }
    }
}
