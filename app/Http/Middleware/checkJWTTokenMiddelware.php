<?php

namespace App\Http\Middleware;

use App\Traits\response;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;


class checkJWTTokenMiddelware
{
    use response;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard)
    {
        try {
            config(['auth.defaults.guard' => 'user_api']);
            $user = JWTAuth::parseToken()->authenticate();
            $token = JWTAuth::getToken();
            $payload = JWTAuth::getPayload($token)->toArray();
            
            if ($payload['type'] != $guard) 
                return $this->failed(trans('auth.Not authorized'), 401, 'E01');

        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return $this->failed(trans('auth.Token is Invalid'), 401, 'E01');
            } else if ($e instanceof TokenExpiredException) {
                return $this->failed(trans('auth.Token is Expired'), 401, 'E01');
            } else {
                return $this->failed(trans('auth.Authorization Token not found'), 404, 'E04');
            }
        }

        return $next($request);
    }
}
