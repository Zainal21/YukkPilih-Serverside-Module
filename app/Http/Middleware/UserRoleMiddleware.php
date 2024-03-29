<?php

namespace App\Http\Middleware;

use Closure;

class UserRoleMiddleware
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
        if(!auth()->user()-role === 'user'){
            return redirect()->route('login');
        }
        return $next($request);
    }
}
