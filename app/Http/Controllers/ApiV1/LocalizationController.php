<?php

namespace App\Http\Controllers\APIV1;

use App\City;
use App\State;
use App\Country;
use App\Repositories\Api\APiRepository;
use App\Http\Controllers\Controller;

class LocalizationController extends Controller
{
    /**
     * Get countries
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     *
     * @return @return Illuminate\Http\JsonResponse
     */
    public function countries(ApiRepository $apiRepository)
    {
        $data = [7, 38, 42, 43, 50, 51, 67, 79, 161];
        $countries = Country::whereIn('id', $data)->get();

        return (!$countries->isEmpty()) ? $apiRepository->successResponse($countries->count(), $countries, null, 200) : $apiRepository->failedResponse(trans('no_country_found'), 404);
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
        
        return (!$states->isEmpty()) ? $apiRepository->successResponse($states->count(), $states, null, 200) : $apiRepository->failedResponse(trans('no_state_found'), 404);
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

        return (!$cities->isEmpty()) ? $apiRepository->successResponse($cities->count(), $cities, null, 200) : $apiRepository->failedResponse(trans('no_city_found'), 404);
    }
}
