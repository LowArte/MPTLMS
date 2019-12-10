<?php

namespace App\Http\Controllers\RouteControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CallSchedule;
use App\Models\Places;

class TimetableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'profilactic']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callSchedule = CallSchedule::get();
        $calls = array();
        foreach($callSchedule as $call){
            array_push($calls,["place"=>Places::where("id",$call->place_id)->first()["place_name"],"schedule"=>$call->call_schedule]);
        }
        $panel_array = array(
            array(
                "header"  => "Расписание звонков",
                "content" => "call-schedule-f/CallSchedule",
                "props"   => array('_time_table'=>json_encode($calls))
            )
        );
        return view('components/timetable', ["panel_array"=>$panel_array]);
    }
}
