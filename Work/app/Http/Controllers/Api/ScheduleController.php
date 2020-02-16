<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Update\UpdateScheduleModification;
use App\Repositories\ModelRepository\ScheduleRepository;
use Illuminate\Http\Request;

class ScheduleController extends BaseController
{ 
    /**
     * Get schedule
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getScheduleByGroupId($id, ScheduleRepository $scheduleRepository)
    {
        $schedule = $scheduleRepository->getScheduleByGroup($id);
        return response()->json(compact('schedule'));
    }
     /**
     * Get schedule
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getScheduleBildByGroupId($id, ScheduleRepository $scheduleRepository)
    {
        $schedule = $scheduleRepository->getScheduleBildByGroup($id);
        return response()->json(compact('schedule'));
    }

    /**
     * edit schedule from database
     * @param id schedule id
     * @return JSON
     */
    public function edit($id, Request $request, ScheduleRepository $scheduleRepository, UpdateScheduleModification $updateScheduleModification)
    {
        $data = $request->all();
        $scheduleId = $scheduleRepository->getScheduleIdByGroup($id);
        $result = $updateScheduleModification->updateScheduleInDatabase($scheduleId, $data['schedule']);

        if($result)
        {
            return response()->json(["success"=>true]);
        }
        return response()->json(["error"=>"Расписание не сохранено"],400);
    }
}
