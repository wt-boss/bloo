<?php

namespace App\Http\Controllers\ApiV1;

use App\City;
use Exception;
use App\Operation_User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Operation;
use App\Repositories\Api\ApiRepository;
use App\Site;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
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
            // Retrieve user's operations
            $user_operations_ids = Operation_User::whereUserId($user->id)->pluck('operation_id');
            // Current operation
            $operation = Operation::whereIn('id', $user_operations_ids)
                                            ->whereStatus('EN COURS')
                                            ->get();
            
            return ($operation->isEmpty()) ? $apiRepository->jsonResponse(trans('no_current_operation'), Response::HTTP_OK) : $apiRepository->jsonResponse($operation->count(), Response::HTTP_FOUND, $operation);
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
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
        try {
            $user = JWTAuth::user();
            // Retrieve user's operations
            $user_operations_ids = Operation_User::whereUserId($user->id)->pluck('operation_id');
            $current_date = Carbon::now()->toDateString();
            // Passed operations
            $operations = Operation::whereIn('id', $user_operations_ids)
                                    ->whereDate('date_end', '<', $current_date)
                                    ->where('status', '!=', 'EN COURS')
                                    ->get();
            $collect = collect();
            return ($operations->isEmpty()) ? $apiRepository->jsonResponse(trans('no_operation'), Response::HTTP_OK) : $apiRepository->jsonResponse($operations->count(), Response::HTTP_FOUND, $operations);
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
        
    }

    /**
     * Retrieve operations for specified city
     * 
     * @param int $city_id
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function cityOperations($city_id, ApiRepository $apiRepository)
    {
        try {
            $city = City::findOrFail($city_id)->ville;
            $city_operations_ids = DB::table('city_operation')
                                  ->whereCityId($city->id)
                                  ->pluck('operation_id');

            $operations = Operation::whereIn('id', $city_operations_ids)->get();
            
            return ($operations->isEmpty()) ? $apiRepository->jsonResponse(trans('no_site_operation'), Response::HTTP_OK) : $apiRepository->jsonResponse($operations->count(), Response::HTTP_FOUND, $operations);                         
        } catch (Exception  $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
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
        try {
            $operation = Operation::findOrFail($operation_id);
            $city = City::findOrFail($city_id)->ville;
            $sites = Site::whereOperationId($operation)
                         ->whereVille($city)
                         ->get();

        return ($sites->isEmpty()) ? $apiRepository->successResponse(trans('no_site_operation'), null, null, Response::HTTP_OK) : $apiRepository->successResponse($sites->count(), $sites, null, Response::HTTP_FOUND);                         
        } catch (Exception  $e) {
            return $apiRepository->failedResponse($e->getMessage());
        }
    }
}
