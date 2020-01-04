<?php

namespace App\Http\Controllers\RouteControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departament;
use App\Models\Discipline;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\ScheduleSwap;
use App\User;
use Debugbar;

class BildReplacementsController extends Controller
{
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
        
        $teachers = Teacher::get();
        $teachersName = array();
        for ($i = 0; $i < count($teachers); $i++) {
            $user = User::where('id', $teachers[$i]['user_id'])->first();
            array_push($teachersName, ['name' => $user['name'] . " " . $user['secName'] . " " . $user['thirdName']]);
        };
        $discip = Discipline::get();

        return view('components/bild-replacements', [
            "departaments_info"=>array(
                "departaments"=>$departaments,
                "selected_departament"=>$selected_departament
            ),
            "groups_info"=>array(
                "groups"=>$groups,
                "selected_group"=>$selected_group
            ),
            "teachers"=>$teachersName,
            "discip"=>$discip,
        ]);
    }

    public function save(Request $request)
    {
        $jsonreplacement = json_encode($request['replacement']);  
        $replacement = new ScheduleSwap();
        $replacement->swap_date = $request['date'];
        $replacement->swap = $jsonreplacement;
        $replacement->schedule_id = json_decode(Schedule::where("group_id",$request['group_id'])->first()->id);
        $replacement->save();
        return response()->json(['success' => true]);
    }
}