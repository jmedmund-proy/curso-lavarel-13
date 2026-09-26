<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserIsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user());
        // if(Auth::user()->role != 'admin'){
        // Esto verifica si es admin o no y redirige
        // if(auth()->user() && auth()->user()->role != 'admin'){
        //     return to_route('blog.index');
        // }
        return $next($request);
    }
}
