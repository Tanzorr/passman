<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure(Request): (Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }
}
