<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;


class PlaceManagmentController extends BaseController
{
     /**
     * Show the application place managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PlaceRepository $placeRepository)
    {
        $places = $placeRepository->getPlaces();
        return view('roles.admin.place-managment', compact('places'));
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