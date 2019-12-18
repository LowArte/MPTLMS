<?php

namespace App\Http\Controllers\RouteControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CallSchedule;
use App\Models\Departament;
use App\Models\Group;
use App\Models\Places;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;


class BildTimetableController extends Controller
{

    private function get_schedule($group_id){
        $schedule =json_decode(Schedule::where("group_id",$group_id)->first()->schedule);
        foreach ((array)$schedule as $days => $row) {
            $place = Places::where("id", $schedule->{$days}->Place)->first();
            $time = json_decode(CallSchedule::where("place_id",$place->id)->first()->call_schedule);
            $schedule->{$days}->Place = $place->place_name;
            foreach ((array)$time as $lessons =>$row2) {
                $schedule->{$days}->{$lessons}->time = $time->{$lessons};
            }      
        }
        return $schedule;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'profilactic']);
    }

    public function groupByDepartamentId(Request $request)
    {
        $groups = Group::where("departaments_id",$request["dep_id"])->get();
        return response()->json(array(
            "groups"=>$groups
        ));
    }

    public function scheduleByGroupId(Request $request)
    {
        $schedule = $this->get_schedule($request["group_id"]);
        return response()->json(array(
            "schedule"=>$schedule
        ));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $departaments = Departament::get();
        $groups = Group::where("departaments_id",$departaments[0]['id'])->get();
        $selected_group = null;
        $selected_departament = null;

        if($user["post_id"] == 2){
            $student = Student::where("user_id",$user["id"])->first();           
            $selected_group = Group::where("id",$student["group_id"])->first();
            $groups = Group::where("departaments_id",$selected_group['departaments_id'])->get();
            $selected_departament = Departament::where("id",$selected_group["departaments_id"])->first();
        }
        else
        {
            $selected_group = $groups[0];
            $selected_departament = $departaments[0];
        }

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

        return view('components/bild-timetable',
        [
            "panel_array"=>$panel_array,

            "departaments_info"=>array(
                "departaments"=>$departaments,
                "selected_departament"=>$selected_departament
            ),
            "groups_info"=>array(
                "groups"=>$groups,
                "selected_group"=>$selected_group
            ),
            "schedule"=>$this->get_schedule($selected_group['id'])
        ]
        );
    }
}