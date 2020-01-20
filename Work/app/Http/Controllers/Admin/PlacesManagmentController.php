<?php

namespace App\Http\Controllers\Admin;

use App\Modifications\Create\CreatePlacesModification;
use App\Modifications\Create\CreateUserModification;
use App\Modifications\Delete\DeleteUserModification;
use App\Modifications\Update\UpdateUserModification;
use App\Repositories\PlaceRepository;
use CreatePlacesTable;
use Illuminate\Http\Request;


class PlacesManagmentController extends BaseController
{
     /**
     * Show the application user managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PlaceRepository $placeRepository)
    {
        $places = $placeRepository->getPlaces();
        return view('roles.admin.places', compact('places'));
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