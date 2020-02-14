<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ModelRepository\PlaceRepository;
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
}