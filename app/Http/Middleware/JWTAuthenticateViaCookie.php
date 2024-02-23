<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTAuthenticateViaCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('jwt_auth');
        if(!isset($token))
            return response()->json(['message' => 'Unauthorized'], 401);
        $request->headers->set('Authorization', 'Bearer '.$token);
        if($request->bearerToken() == null)
            return response()->json(['message' => 'Unauthorized'], 401);
        if($request->bearerToken() != $token)
            return response()->json(['message' => 'Unauthorized'], 401);
        $request->headers->set('Authorization', 'Bearer '.$token);
        return $next($request);
    }
}
