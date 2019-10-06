<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule as Sch;
use Illuminate\Support\Facades\Storage;
use DB;
use Debugbar;

class Schedule extends Controller
{
    /*
        Функция get запроса для получения расписания
    */
    public function get_schedule(Request $request)
    {
        Debugbar::info ($request['group']);
        $schedule = Sch::join('groups', 'schedules.group_id', '=', 'groups.id')
            ->where('groups.group_name','=',$request['group'])
            ->select('schedules.schedule')
            ->get();       
        return response()->json(json_decode($schedule[0]->schedule),200);

    }
    /*
        Функция post запроса для сохранения расписания
        Расписание находится в поле schedule
    */
    public function save(Request $request){
<<<<<<< HEAD
        $schedule = Sch::join('groups', 'schedules.group_id', '=', 'groups.id')
            ->where('groups.group_name','=',$request['group']);           
        $schedule->update(['schedules.schedule' => $request['schedule']]);
=======
        Debugbar::info ($request);
        Sch::join('groups', 'schedules.group_id', '=', 'groups.id')
            ->where('groups.group_name','=',$request['group'])
            ->update(['schedules.schedule' => json_encode($request['schedule'])]);
        
>>>>>>> dcc5cd7e78547fe208baaba683d27c6a487bf7e2
        return response()->json([
            'success' => true], 200);
    }
}
