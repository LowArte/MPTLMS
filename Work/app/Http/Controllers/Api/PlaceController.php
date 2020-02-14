<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\PlaceRepository;

class PlaceController extends BaseController
{ 

    /**
     * get places from database
     * @return JSON
     */
    public function getPlaces(PlaceRepository $placeRepository)
    {
        $places = $placeRepository->getPlaces();
        return response()->json(compact('places'));
    }
}
