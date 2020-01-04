<?php

namespace App\Http\Controllers\RouteControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departament;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\ScheduleSwap;
use Debugbar;

class ReplacementsController extends Controller
{
    public function getReplacements(Request $request)
    {
        return response()->json(array(
            "replacements"=>ScheduleSwap::
                where([
                    ["swap_date", '=', $request['date']],
                    ["schedule_id", '=', json_decode(Schedule::where("group_id",$request['group_id'])->first()->id)],
                ])
                ->join('schedules', 'schedule_swaps.schedule_id', '=', 'schedules.id')
                ->join('groups', 'schedules.group_id', '=', 'groups.id')
                ->orderBy('groups.id', 'asc')
                ->select('schedule_swaps.id', 'schedule_swaps.swap_date', 'schedule_swaps.swap', 'schedule_swaps.created_at', 'groups.group_name')
                ->orderBy('swap_date', 'desc')
                ->get()
            )
        );
    }

    public function getAllReplacementsByGroup(Request $request)
    {
        return response()->json(array(
            "replacements"=>ScheduleSwap::
                where("schedule_id", Schedule::where("group_id",$request['group_id'])->first()->id)
                ->join('schedules', 'schedule_swaps.schedule_id', '=', 'schedules.id')
                ->join('groups', 'schedules.group_id', '=', 'groups.id')
                ->orderBy('groups.id', 'asc')
                ->select('schedule_swaps.id', 'schedule_swaps.swap_date', 'schedule_swaps.swap', 'schedule_swaps.created_at', 'groups.group_name')
                ->orderBy('swap_date', 'desc')
                ->get()
            )
        );
    }

    public function getAllReplacementsByDate(Request $request)
    {
        Debugbar::info($request);
        return response()->json(array(
            "replacements"=>ScheduleSwap::
                where("swap_date", $request['date'])
                ->join('schedules', 'schedule_swaps.schedule_id', '=', 'schedules.id')
                ->join('groups', 'schedules.group_id', '=', 'groups.id')
                ->orderBy('groups.id', 'asc')
                ->select('schedule_swaps.id', 'schedule_swaps.swap_date', 'schedule_swaps.swap', 'schedule_swaps.created_at', 'groups.group_name')
                ->orderBy('swap_date', 'desc')
                ->get()
            )
        );
    }

    public function deleteReplacement (Request $request)
    {
        try
        {
            $replacement = ScheduleSwap::where("id",$request->id)->first();
            $replacement->delete();
            return response()->json(['success'=>true]);
        }
        catch(MNF $e)
        {
            return response()->json(['error'=>$e],400);
        }
    }

    public function getAllReplacements()
    {
        return response()->json(array(
            "replacements"=>ScheduleSwap::
                join('schedules', 'schedule_swaps.schedule_id', '=', 'schedules.id')
                ->join('groups', 'schedules.group_id', '=', 'groups.id')
                ->orderBy('groups.id', 'asc')
                ->select('schedule_swaps.id', 'schedule_swaps.swap_date', 'schedule_swaps.swap', 'schedule_swaps.created_at', 'groups.group_name')
                ->orderBy('swap_date', 'desc')
                ->get()
            )
        );
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
        $today = date("Y-m-d"); //Получение текущей даты

        //Получение замен
        $replacements = ScheduleSwap::
            where([
                ["swap_date", '=', $today],
                ["schedule_id", '=', json_decode(Schedule::where("group_id",$selected_group->id)->first()->id)],
            ])
            ->join('schedules', 'schedule_swaps.schedule_id', '=', 'schedules.id')
            ->join('groups', 'schedules.group_id', '=', 'groups.id')
            ->orderBy('groups.id', 'asc')
            ->select('schedule_swaps.id', 'schedule_swaps.swap_date', 'schedule_swaps.swap', 'schedule_swaps.created_at', 'groups.group_name')
            ->orderBy('swap_date', 'desc')
            ->get();
        
        return view('components/replacements', [
            "departaments_info"=>array(
                "departaments"=>$departaments,
                "selected_departament"=>$selected_departament
            ),
            "groups_info"=>array(
                "groups"=>$groups,
                "selected_group"=>$selected_group
            ),
            "replacements"=>$replacements,
        ]);
    }
}