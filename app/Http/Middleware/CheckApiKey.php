<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if ($apiKey !== env('API_KEY')) {
            return response()->json([
                'status' => 401,
                'message' => 'Accès refusé : Clé API invalide'
            ], 401);
        }
        return $next($request);
    }
}
