<?php

namespace App\Http\Controllers\APIV1;

use App\City;
use App\State;
use App\Country;
use Exception;
use Illuminate\Http\Response;
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

            return (!$countries->isEmpty()) ? $apiRepository->jsonResponse($countries->count(), Response::HTTP_FOUND, $countries) : $apiRepository->jsonResponse(trans('no_country_found'), Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
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
        try {
            $states = State::where('country_id', $id)->get();
        
            return (!$states->isEmpty()) ? $apiRepository->jsonResponse($states->count(), Response::HTTP_FOUND, $states) : $apiRepository->jsonResponse(trans('no_state_found'), Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
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
        try {
            $cities = City::where('state_id', $id)->get();

        return (!$cities->isEmpty()) ? $apiRepository->jsonResponse($cities->count(), Response::HTTP_FOUND, $cities) : $apiRepository->jsonResponse(trans('no_city_found'), Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return $apiRepository->jsonResponse($e->getMessage());
        }
    }
}

