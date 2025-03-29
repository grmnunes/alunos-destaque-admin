<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $providedToken = $request->header('Authorization');
        $expectedToken = config('sme.api.token');

        if (! $providedToken || $providedToken !== 'Bearer '.$expectedToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
