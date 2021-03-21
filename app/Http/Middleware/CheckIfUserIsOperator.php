<?php

namespace App\Http\Middleware;

use App\Repositories\Api\ApiRepository;
use Closure;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class CheckIfUserIsOperator
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
        $user_role = JWTAuth::getClaim('role');

        if ($user_role !== 1) {
            return $apiRepository->failedResponse(trans('required_to_be_operator'), Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
