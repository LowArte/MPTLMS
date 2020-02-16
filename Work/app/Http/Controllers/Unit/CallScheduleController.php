<?php

namespace App\Http\Controllers\Unit;

use App\Repositories\ModelRepository\CallScheduleRepository;
use App\Repositories\ModelRepository\PlaceRepository;
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
        return view('roles.unit.call-schedule',compact('timeTable', 'places'));
    }
}
