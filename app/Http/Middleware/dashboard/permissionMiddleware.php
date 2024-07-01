<?php

namespace App\Http\Middleware\dashboard;

use Closure;
use Illuminate\Http\Request;

class permissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if(auth('user')->user()->has_permission($permission)){
            return $next($request);
        } else {
            return abort(404);
        }

    }
}
