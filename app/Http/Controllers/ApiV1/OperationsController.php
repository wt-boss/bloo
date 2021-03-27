<?php

namespace App\Http\Controllers\ApiV1;

use App\City;
use App\Site;
use App\User;
use Exception;
use App\Operation;
use Carbon\Carbon;
use App\Operation_User;
use App\Operation_user_save;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
     * @return Illuminate\Http\JsonResponse
     */
    public function operation()
    {
        try {
            $user = JWTAuth::user();
            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::id() , true , $expireAt);
            // Retrieve user's operations
            $user_operations_ids = Operation_User::whereUserId($user->id)->pluck('operation_id');
            // Current operation
            $operation = Operation::whereIn('id', $user_operations_ids)
                                   ->whereStatus('EN COUR')
                                   ->get();
            if($operation->isEmpty()){
                return $this->api->jsonResponse(trans('no_current_operation'), Response::HTTP_OK);
            }
            
            return $this->api->jsonResponse($operation->count(), Response::HTTP_OK, $operation, null, $operation->first()->form->code);
        } catch (Exception $e) {
            return $this->api->jsonResponse($e->getMessage());
        }
    }

    /**
     * User's operations history (passed operations)
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function passedOperations()
    {
        try {
            $user = JWTAuth::user();
            $expireAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online-'.Auth::id() , true , $expireAt);
            // Retrieve user's operations
            $user_operations_ids = Operation_user_save::whereUserId($user->id)->pluck('operation_id');
            // Passed operations
            $operations = Operation::whereIn('id', $user_operations_ids)
                                    ->whereStatus('TERMINER')
                                    ->get();
            return $this->api->conditionnalResponse($operations, 'no_operation');
        } catch (Exception $e) {
            return $this->api->jsonResponse($e->getMessage());
        }

    }

    /**
     * Retrieve not begin's operations for specified city
     *
     * @param int $city_id
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function cityOperations($city_id)
    {
        try {
            $city = City::findOrFail($city_id);
            if(!$city){
                return $this->api->jsonResponse(trans('no_city_found'), Response::HTTP_OK);
            }
            $city_operations_ids = DB::table('city_operation')
                                      ->whereCityId($city->id)
                                      ->pluck('operation_id');
            $operations = Operation::whereIn('id', $city_operations_ids)
                                    ->whereStatus('CREER')
                                    ->get();
            return $this->api->conditionnalResponse($operations, 'no_operation');
        } catch (Exception $e) {
            return $this->api->jsonResponse($e->getMessage());
        }
    }

    /**
     * City's sites for specified operation
     *
     * @param int $operation_id
     * @param int $city_id
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function operationSites($operation_id, $city_id)
    {
        try {
            $operation = Operation::findOrFail($operation_id);
            $city = City::findOrFail($city_id);
            if (!$operation) {
                return $this->api->jsonResponse(trans('no_operation'), Response::HTTP_OK);
            }else if(!$city){
                return $this->api->jsonResponse(trans('no_city_found'), Response::HTTP_OK);
            }
            $sites = Site::whereOperationId($operation->id)
                         ->whereCityId($city->id)
                         ->get();
            return $this->api->conditionnalResponse($sites, 'no_site_operation');
        } catch (Exception $e) {
            return $this->api->jsonResponse($e->getMessage());
        }
    }

    /**
     * Cities' country (current user's country) for not begin's operations
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function operationsCities()
    {
        try {
            $auth_id = JWTAuth::parseToken()->getPayload()->get('sub');
            $user = User::findOrFail($auth_id);
            $operations_ids = Operation::whereStatus('TERMINER')->pluck('id');
            $sites = Site::whereIn('operation_id', $operations_ids)
                          ->whereCountryId($user->country_id)
                          ->pluck('city_id');
            $cities = City::whereIn('id', $sites)->get();
            return $this->api->conditionnalResponse($cities, 'no_city_found');
        } catch (Exception $e) {
            return $this->api->jsonResponse($e->getMessage());
        }
    }
}
