<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use App\Models\CallSchedule;
use App\Models\Places;
use App\Models\Departament;

class ConstructorTimeTableController extends Controller
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
        $call = CallSchedule::get();
        $places = Places::get();

        $deps = Departament::get();
        return view('components/contimetable', [
            "call" => json_encode($call),
            "place" => json_encode($places),
            "dep" => json_encode([
                "departaments" => json_encode($deps),
                "cur_departament" => -1
            ]),
        ]);
    }
}
