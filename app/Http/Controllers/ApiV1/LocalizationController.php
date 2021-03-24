<?php

namespace App\Http\Controllers\APIV1;

use App\City;
use App\State;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Api\APiRepository;

class LocalizationController extends Controller
{
    protected $token;

    public function __construct(Request $request)
    {
        $this->token = $request->header('Authorization');
    }
    
    /**
     * Get countries
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function countries(ApiRepository $apiRepository)
    {
        $data = [7, 38, 42, 43, 50, 51, 67, 79, 161];
        $countries = Country::whereIn('id', $data)->get();

        return (!$countries->isEmpty()) ? $apiRepository->successResponse($countries->count(), $countries, null, Response::HTTP_FOUND) : $apiRepository->failedResponse(trans('no_country_found'), Response::HTTP_NOT_FOUND);
    }

    /**
     * Get states for specific country
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * @param int $id
     *
     * @return @return Illuminate\Http\JsonResponse
     */
    public function states($id, ApiRepository $apiRepository)
    {
        $states = State::where('country_id', $id)->get();
        
        return (!$states->isEmpty()) ? $apiRepository->successResponse($states->count(), $states, null, Response::HTTP_FOUND) : $apiRepository->failedResponse(trans('no_state_found'), Response::HTTP_NOT_FOUND);
    }

    /**
     * Get cities for specific state
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * @param int $id
     *
     * @return @return Illuminate\Http\JsonResponse
     */
    public function cities($id, ApiRepository $apiRepository)
    {
        $cities = City::where('state_id', $id)->get();

        return (!$cities->isEmpty()) ? $apiRepository->successResponse($cities->count(), $cities, null, Response::HTTP_FOUND) : $apiRepository->failedResponse(trans('no_city_found'), Response::HTTP_NOT_FOUND);
    }
}

