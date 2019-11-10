<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use App\Models\CallSchedule;
use App\Models\Places;
use App\Models\Departament;
use App\Models\Discipline;
use App\Models\Teacher;
use App\User;

class ConstructorTimeTableController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $call = CallSchedule::get();
        $places = Places::get();
        $teachers = Teacher::get();

        $teachersName = array();
        for ($i = 0; $i < count($teachers); $i++) {
            $user = User::where('id', $teachers[$i]['user_id'])->first();
            array_push(
                $teachersName,
                ['name' => $user['name'] . " " . $user['secName'] . " " . $user['thirdName']]
            );
        }
        $discip = Discipline::get();

        $deps = Departament::get();
        return view('components/contimetable', [
            "call" => $call,
            "place" => $places,
            "dep" => [
                "departaments" => $deps,
                "cur_departament" => -1
            ],
            "teachers" => $teachersName,
            "discip" => $discip
        ]);
    }
}
