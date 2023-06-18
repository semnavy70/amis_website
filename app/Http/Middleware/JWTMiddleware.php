<?php

namespace Vanguard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\File;

class JWTMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        try {
            $jwt = $request->bearerToken();
            $publicKey = File::get(base_path("jwt_secret.p8"));

            $decoded = JWT::decode($jwt, new Key($publicKey, 'ES256'));
            if ($decoded->username) {
                return $next($request);
            }

            return 404;
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
