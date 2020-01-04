<?php

namespace App\Http\Controllers\RouteControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CallSchedule;
use App\Models\Departament;
use App\Models\Discipline;
use App\Models\Group;
use App\Models\Places;
use App\Models\Schedule;
use App\Models\Teacher;
use App\User;


class BildTimetableController extends Controller
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

    private function get_schedule($group_id)
    {
        $schedule = json_decode(Schedule::where("group_id",$group_id)->first()->schedule);
        return $schedule;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departaments = Departament::get();
        $groups = Group::where("departaments_id",$departaments[0]['id'])->get();

        $selected_group = $groups[0];
        $selected_departament = $departaments[0];

        $callSchedule = CallSchedule::get();
        $calls = array();

        foreach($callSchedule as $call)
        {
            array_push($calls,["place"=>Places::where("id",$call->place_id)->first()["place_name"],"schedule"=>$call->call_schedule]);
        }
        
        $panel_array = array(
            array(
                "header"  => "Расписание звонков",
                "content" => "call-schedule-f/CallSchedule",
                "props"   => array('_time_table'=>json_encode($calls))
            )
        );

        $places = Places::get();
        $teachers = Teacher::get();

        $teachersName = array();
        for ($i = 0; $i < count($teachers); $i++) {
            $user = User::where('id', $teachers[$i]['user_id'])->first();
            array_push($teachersName, ['name' => $user['name'] . " " . $user['secName'] . " " . $user['thirdName']]);
        };
        $discip = Discipline::get();

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
            "places"=>$places,
            "teachers"=>$teachersName,
            "discip"=>$discip,
            "schedule"=>$this->get_schedule($selected_group['id'])
        ]
        );
    }
    
    public function save(Request $request)
    {
        foreach ($request['schedule'] as $i) 
        {
            foreach ($i as $j) 
            {
                $j = json_encode($j);
            }
        }
        Schedule::where('group_id', $request['group_id'])->update(['schedule' => json_encode($request['schedule'])]);
        return response()->json(['success' => true]);
    }
}