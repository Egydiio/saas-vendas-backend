<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateAppToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('X-APP-TOKEN') !== env('APP_FRONT_TOKEN')) {
            return response()->json(['message' => 'Acesso não autorizado.'], 401);
        }

        return $next($request);
    }
}
