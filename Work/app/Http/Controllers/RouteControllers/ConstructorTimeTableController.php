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
    public function save(Request $request)
    {
        return response()->json(['success'=>true]);
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
            "call" => json_encode($call),
            "place" => json_encode($places),
            "dep" => json_encode([
                "departaments" => json_encode($deps),
                "cur_departament" => -1
            ]),
            "teachers" => json_encode($teachersName),
            "discip" => json_encode($discip)
        ]);
    }
}
