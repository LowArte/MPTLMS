<?php

namespace App\Http\Controllers\RouteControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallScheduleController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','profilactic']);
    }

    public function index()
    {
        $callSchedule = CallSchedule::get();
        $calls = array();
        foreach($callSchedule as $call){
            array_push($calls,["place"=>Places::where("id",$call->place_id)->first()["place_name"],"schedule"=>$call->call_schedule]);
        }
        Debugbar::info($calls);
        return view('components/call-schedule', ["calls"=>$calls]);
    }
}
