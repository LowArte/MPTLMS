<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\CallSchedule;
use Debugbar;

class ConCallScheduleController extends Controller
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
        $places = Places::get();
        $callSchedule = CallSchedule::get();
        return view('components/concallschedule', ["place" => json_encode($places), "callSch" => json_encode($callSchedule)]);
    }
}
