<?php

namespace App\Http\Controllers\ApiV1;

use Exception;
use App\Operation_User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Operation;
use App\Repositories\Api\ApiRepository;
use Illuminate\Http\Response;

class OperationsController extends Controller
{
    protected $token;

    public function __construct(Request $request)
    {
        $this->token = $request->header('Authorization');
    }

    /**
     * Display user's current operation
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function operation(ApiRepository $apiRepository)
    {
        try {
            $user = JWTAuth::user();
            // $user_role = JWTAuth::getClaim('role');
            $users_operations_id = Operation_User::all()->pluck('user_id')->toArray();
            // Check if user has an operation
            if(!in_array($user->id, $users_operations_id)){
                return $apiRepository->successResponse(trans('no_operation'), null, null, Response::HTTP_OK);
            }

            $operations_user = Operation_User::whereUserId($user->id)->pluck('operation_id');
            $operations = Operation::whereIn('id', $operations_user)->get();

            $current_operation = collect();
            foreach($operations as $operation){
                if ($operation->whereDate('date_start', '>=', date('d'))->whereDate('date_end', '<=', date('d'))) {
                    $current_operation->push($operation);
                }
            }
            return ($current_operation->isEmpty()) ? $apiRepository->successResponse(trans('no_current_operation'), null, null, Response::HTTP_OK) : $apiRepository->successResponse(trans('operation'), $current_operation, null, Response::HTTP_FOUND);
        } catch (Exception $e) {
            return $apiRepository->failedResponse($e->getMessage());
        }
    }

    /**
     * User's operations history (passed operations)
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function passedOperations(ApiRepository $apiRepository)
    {

    }

    /**
     * Operations for specified city
     * 
     * @param int $city_id
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function cityOperations($city_id, ApiRepository $apiRepository)
    {
        
    }

    /**
     * City's sites for specified operation
     * 
     * @param int $operation_id
     * @param int $city_id
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function operationSites($operation_id, $city_id, ApiRepository $apiRepository)
    {
        
    }
}
