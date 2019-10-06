<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule as Sch;
use Illuminate\Support\Facades\Storage;
use DB;

class Schedule extends Controller
{
    /*
        Функция get запроса для получения расписания
    */
    public function get_schedule(Request $request)
    {
        $schedule = Sch::join('groups', 'schedules.group_id', '=', 'groups.id')
            ->where('groups.group_name','=',$request['group'])
            ->select('schedules.schedule')
            ->get();
        return response()->json($schedule,200);
    }
    /*
        Функция post запроса для сохранения расписания
        Расписание находится в поле schedule
    */
    public function save(Request $request){
        Sch::join('groups', 'schedules.group_id', '=', 'groups.id')
            ->where('groups.group_name','=',$request['group'])
            ->update(['schedules.schedule' => $request['schedule']]);
        return response()->json([
            'success' => true], 200);
    }
}
