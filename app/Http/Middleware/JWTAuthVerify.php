<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use App\Repositories\Api\ApiRepository;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $apiRepository->failedResponse(trans('token_invalid'));
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $apiRepository->failedResponse(trans('token_expired'));
            }else{
                return $apiRepository->failedResponse(trans('unauthorized'), 401);
            }
        }
            return $next($request);
    }
}
