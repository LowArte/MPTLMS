<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\CallSchedule;
use App\Models\Group;
use App\Models\Departament;
use Debugbar;

class TimetableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::get();
        $call = CallSchedule::get();
        Debugbar::info($call);
        $groups = Group::get();
        $dep = Departament::get();
        return view('components/timetable',[
            "schedule"=>json_encode($schedule),
            "call"=> json_encode($call),
            "groups"=>json_encode($groups),
            "dep"=>json_encode($dep),
        ]);
    }
}
