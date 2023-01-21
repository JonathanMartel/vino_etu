<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user() || !auth()->user()->is_admin){
            abort(403);
        }

        return $next($request);
    }
}
