<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class TokenAuth extends BaseMiddleware
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
        if (! $token = $this->auth->setRequest($request)->getToken()){
//            return $this->respond('tymon.jwt.absent', 'Token Not Provided', 400);
            return response()->json(['message' => 'Token Not Provided'], 400);
        }

        try {
            $user = $this->auth->authenticate($token);
        }
        catch (TokenExpiredException $e){
//            return $this->respond('tymon.jwt.expired', 'Token Expired', $e->getStatusCode(), [$e]);
            return response()->json(['message' => 'Token Expired'], 401);
        }
        catch (JWTException $e){
//            return $this->respond('tymon.jwt.invalid', 'Token Invalid', $e->getStatusCode(), [$e]);
            return response()->json(['message' => 'Token Invalid'], 401);
        }

        if (! $user){
//            return $this->respond('tymon.jwt.user_not_found', 'User Not Found', 404);
            return response()->json(['message' => 'User Not Found'], 404);
        }

        return $next($request);
    }
}
