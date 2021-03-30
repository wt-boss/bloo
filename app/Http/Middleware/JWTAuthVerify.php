<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use App\Repositories\Api\ApiRepository;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JWTAuthVerify extends BaseMiddleware
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
        $apiRepository = new ApiRepository;
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException){
                return $apiRepository->jsonResponse(false, trans('token_invalid'), Response::HTTP_UNAUTHORIZED);
            }else if ($e instanceof TokenExpiredException){
                return $apiRepository->jsonResponse(false, trans('token_expired'), Response::HTTP_UNAUTHORIZED);
            }else{
                return $apiRepository->jsonResponse(false, trans('unauthorized'), Response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}
