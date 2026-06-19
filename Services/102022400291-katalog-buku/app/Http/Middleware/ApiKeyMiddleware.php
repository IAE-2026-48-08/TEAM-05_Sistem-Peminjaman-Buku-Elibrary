<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-IAE-KEY') !== '102022400291') {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid API Key'
            ], 401);
        }

        return $next($request);
    }
}