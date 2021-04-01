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
    public $api;
    public function __construct(ApiRepository $apiRepository)
    {
        $this->api = $apiRepository;
    }
    /**
     * Get countries
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function countries()
    {
        try {
            $data = [7, 38, 42, 43, 50, 51, 67, 79, 161];
            $countries = Country::whereIn('id', $data)->get();

            return $this->api->conditionnalResponse($countries, 'no_country_found');
        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Get states for specific country
     * 
     * @param int $country_id
     *
     * @return @return Illuminate\Http\JsonResponse
     */
    public function states($country_id)
    {
        try {
            $states = State::where('country_id', $country_id)->get();
            return $this->api->conditionnalResponse($states, 'no_state_found');
        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Get cities for specific state
     * 
     * @param int $state_id
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function cities($state_id)
    {
        try {
            $cities = City::where('state_id', $state_id)->get();
            return $this->api->conditionnalResponse($cities, 'no_city_found');
        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }

    /**
     * Display specified city
     * 
     * @param int $city_id
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function city($city_id)
    {
        try {
            $city = City::findOrFail($city_id)->get();
            return $this->api->conditionnalResponse($city, 'no_city_found');
        } catch (Exception $e) {
            return $this->api->jsonResponse(false, $e->getMessage());
        }
    }
}