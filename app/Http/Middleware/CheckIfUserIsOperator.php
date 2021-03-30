<?php

namespace App\Http\Middleware;

use Closure;
use App\Operation_User;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\Api\ApiRepository;


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
        $payload = JWTAuth::parseToken()->getPayload();
        $user_role = $payload->get('role');
        // $users_operations_id = Operation_User::all()->pluck('user_id')->toArray();

        if ($user_role !== 1) {
            return $apiRepository->jsonResponse(false, trans('required_to_be_operator'), Response::HTTP_FORBIDDEN);
        }
        // else if(!in_array($payload->get('sub'), $users_operations_id)){
        //     return $apiRepository->jsonResponse(trans('no_operation'), Response::HTTP_OK);
        // }
        return $next($request);
    }
}