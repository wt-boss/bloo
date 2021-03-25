<?php

namespace App\Http\Controllers\APIV1;

use App\City;
use App\State;
use App\Country;
use Exception;
use App\Http\Controllers\Controller;
use App\Repositories\Api\APiRepository;

class LocalizationController extends Controller
{    
    /**
     * Get countries
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function countries(ApiRepository $apiRepository)
    {
        try {
            $data = [7, 38, 42, 43, 50, 51, 67, 79, 161];
            $countries = Country::whereIn('id', $data)->get();

            return $apiRepository->conditionnalResponse($countries, 'no_country_found');
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }

    /**
     * Get states for specific country
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * @param int $country_id
     *
     * @return @return Illuminate\Http\JsonResponse
     */
    public function states($country_id, ApiRepository $apiRepository)
    {
        try {
            $states = State::where('country_id', $country_id)->get();
            return $apiRepository->conditionnalResponse($states, 'no_state_found');
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }

    /**
     * Get cities for specific state
     * 
     * @param App\Repositories\Api\ApiRepository $apiRepository
     * @param int $state_id
     *
     * @return @return Illuminate\Http\JsonResponse
     */
    public function cities($state_id, ApiRepository $apiRepository)
    {
        try {
            $cities = City::where('state_id', $state_id)->get();

            return $apiRepository->conditionnalResponse($cities, 'no_city_found');
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }
}

