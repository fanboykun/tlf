<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ApiAuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(): \Illuminate\Http\JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        setcookie('jwt_auth', $token, time() + 3600 * 24, '/');
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): \Illuminate\Http\JsonResponse
    {
        (string) $token = auth()->refresh();
        $this->setJwtTokenToCookie($token);
        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token) : \Illuminate\Http\JsonResponse
    {
        return response()
        ->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ]);
    }

    /**
     * Set auth token to cookie
     *
     * @param string $token
     * @return void
     */
    protected function setJwtTokenToCookie(string $token) : void
    {
        setcookie('jwt_auth', $token, time() + 3600 * 24, '/');
    }
    /**
     * Unset existsing auth token from cookie
     *
     * @param string $token
     * @return void
     */
    protected function unsetJwtTokenFromCookie(string|array $token) : void
    {
        setcookie('jwt_auth', $token, time() - 3600, '/');
    }

    /**
     * Validate a given token
     * @return \Illuminate\Http\JsonResponse
     */

     public function validateToken() : \Illuminate\Http\JsonResponse
     {
        $is_authenticated = auth('api')->check();
        return response()->json([
            'authenticated' => $is_authenticated
        ]);
     }

     /**
      * validated the auth token from cookie
      * @param Request $request
      * @return \Illuminate\Http\JsonResponse
      */
     public function validateTokenFromCookie(Request $request) : \Illuminate\Http\JsonResponse
     {
        if($request->cookie("jwt_auth") != null) {
            return $this->validateToken();
        }
        return response()->json(['authenticated' => false]);
     }
}
