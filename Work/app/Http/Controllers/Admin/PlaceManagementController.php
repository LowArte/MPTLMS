<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;


class PlaceManagementController extends BaseController
{
     /**
     * Show the application place managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PlaceRepository $placeRepository)
    {
        $places = $placeRepository->getPlaces();
        return view('roles.admin.place-management', compact('places'));
    }    

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