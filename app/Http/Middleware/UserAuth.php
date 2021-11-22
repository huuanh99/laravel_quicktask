<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
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
        if (
            $request->session()->get('user') == null && $request->cookie('email') == null
            && $request->cookie('password') == null
        ) {
            return redirect()->route('loginview');
        }
        
        return $next($request);
    }
}
