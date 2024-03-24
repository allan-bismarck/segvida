<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\Key;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token de acesso não fornecido'], 401);
        }

        try {
            $keyMaterial = env('JWT_SECRET');
            $key = new Key($keyMaterial, 'HS256');
            $decodedToken = JWT::decode($token, $key);


            $request->merge(['user_id' => $decodedToken->user_id]);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        }
    }
}