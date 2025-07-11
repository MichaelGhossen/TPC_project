<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserActivation
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->flag) {
            return response()->json([
                'message' => 'Your account is deactivated. Please contact the administrator.',
            ], 403);
        }

        return $next($request);
    }
}
