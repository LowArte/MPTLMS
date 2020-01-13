<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CallScheduleRepository;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;

class CallScheduleController extends BaseController
{
    /**
     * Show the application call schedule page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CallScheduleRepository $callScheduleRepository, PlaceRepository $placeRepository)
    {
        $timeTable = $callScheduleRepository->getCallSchedule();
        $places = $placeRepository->getPlaces();
        return view('roles.admin.call-schedule',compact('timeTable', 'places'));
    }
}
