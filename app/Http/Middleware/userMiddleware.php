<?php

namespace App\Http\Middleware;

use Closure;

class userMiddleware
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
        if (!$request->expectsJson()) {
            $response['status'] = false;
            $response['data'] = "Unauthenticated";
            return response()->json($response);
        }
    }
}
