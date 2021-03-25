<?php

namespace App\Http\Controllers\ApiV1;

use App\City;
use App\Site;
use Exception;
use App\Country;
use App\Operation;
use App\User;
use Carbon\Carbon;
use App\Operation_User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ApiRepository;

class OperationsController extends Controller
{
    public $api;

    public function __construct()
    {
        $this->api = new ApiRepository();
    }
    /**
     * Display user's current operation
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function operation()
    {
        try {
            $user = JWTAuth::user();
            // Retrieve user's operations
            $user_operations_ids = Operation_User::whereUserId($user->id)->pluck('operation_id');
            // Current operation
            $operation = Operation::whereIn('id', $user_operations_ids)
                                            ->whereStatus('EN COURS')
                                            ->get();
            return $this->api->conditionnalResponse($operation ,'no_current_operation');
        } catch (Exception $e) {
            return $this->api->jsonResponse($e->getMessage());
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
            return $this->api->conditionnalResponse($operations, 'no_operation');
        } catch (Exception $e) {
            return $this->api->jsonResponse($e->getMessage());
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
            if(!$city){
                return $apiRepository->jsonResponse(trans('no_operation'), Response::HTTP_NOT_FOUND);
            }
            $city_operations_ids = DB::table('city_operation')
                                  ->whereCityId($city->id)
                                  ->pluck('operation_id');

            $operations = Operation::whereIn('id', $city_operations_ids)->get();
            
            return $apiRepository->conditionnalResponse($operations, 'no_site_operation');                         
        } catch (Exception $e) {
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
            if (!$operation || !$city) {
                return $apiRepository->jsonResponse(trans('no_city_found'), Response::HTTP_NOT_FOUND);
            }
            
            $sites = Site::whereOperationId($operation)
                         ->whereVille($city)
                         ->get();

            return $apiRepository->conditionnalResponse($sites, 'no_site_operation');                         
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }

    /**
     * City's country for not begin's operations
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function operationsCities(ApiRepository $apiRepository)
    {
        try {
            $auth_id = JWTAuth::parseToken()->getPayload()->get('sub');
            $user = User::findOrFail($auth_id);
            $country = $user->country_id;
            if(!$country){
                return $apiRepository->jsonResponse(trans('no_country_found'), Response::HTTP_NOT_FOUND);
            }
            
            $current_date = Carbon::now()->toDateString();
            $operations_ids = Operation::where('status', '!=', 'EN COURS')
                                        ->whereDate('date_start', '>', $current_date)
                                        ->pluck('id');
            $sites = Site::whereIn('operation_id', $operations_ids)->pluck('ville');
            $cities = City::whereIn('name', $sites)
                            ->whereCountryId($country)
                            ->get();
            return $apiRepository->conditionnalResponse($cities, 'no_city_found');                         
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }
}
