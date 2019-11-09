<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\CallSchedule;
use App\Models\Group;
use App\Models\Places;
use App\Models\Departament;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException as MNF;
use Debugbar;

use Illuminate\Support\Facades\Auth;

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

    public function groupByDepartamentId (Request $request)
    {
        
        try{
            Departament::where('id',$request['dep_id'])->firstOrFail();       
            $group = Group::where('departaments_id',$request['dep_id'])->get();
            return response()->json(['group'=>$group],200);
        }
        catch(MNF $e)
        {
            Debugbar::info("departament_not_found");
            return response()->json(['error'=>$e],400);
        }
    }

    public function scheduleByGroupId (Request $request)
    {
        try{
            Group::where('id',$request['group_id'])->firstOrFail();       
            $schedule = Schedule::where('group_id',$request['group_id'])->get();
            return response()->json(['schedule'=>$schedule],200);
        }
        catch(MNF $e)
        {
            Debugbar::info("schedule_not_found");
            return response()->json(['error'=>$e],400);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $call = CallSchedule::get();
        $places = Places::get();
        if ($user['post_id'] == 2) {
            $student = Student::where('user_id', $user['id'])->get()[0];

            $group = Group::where('id', $student['group_id'])->get()[0];
            $schedule = Schedule::where('group_id', $group['id'])->get()[0];
 
            $dep = Departament::get();
            $curDep = Departament::where("id",$group['departaments_id'])->first();

            return view('components/timetable', [
                "schedule" => json_encode($schedule),
                "call" => json_encode($call),
                "groups" => json_encode($group),
                "place" => json_encode($places),
                "dep" => json_encode([
                    "departaments" => json_encode($dep),
                    "cur_departament" => json_encode($curDep)
                ]),
            ]);
        }
        else{
            $deps = Departament::get();
            return view('components/timetable', [
                "call" => json_encode($call),
                "place" => json_encode($places),
                "dep" => json_encode([
                    "departaments" => json_encode($deps),
                    "cur_departament" => -1
                ]),
            ]);
        }
    }
}
