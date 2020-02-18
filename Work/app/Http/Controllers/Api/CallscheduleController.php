<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Update\UpdateCallScheduleModification;
use App\Repositories\ModelRepository\CallScheduleRepository;
use Illuminate\Http\Request;

class CallscheduleController extends BaseController
{ 
    /**
     * Edit call schedule
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request, UpdateCallScheduleModification $updateCallScheduleModification, CallScheduleRepository $callScheduleRepository)
    {
        $data = $request->all();
        for($i = 0;$i<count($data['callSchedule']);$i++)
        {
            $callSchedule_id = $callScheduleRepository->getCallScheduleIdByPlace($data['callSchedule'][$i]['place']['id']);
            $result = $updateCallScheduleModification->updateCallScheduleInDatabase($callSchedule_id, $data['callSchedule'][$i]['schedule']);
            if(!$result)
                return response()->json(["error"=>"Расписание не сохранено"],400);
        }
        return response()->json(["success"=>true]);
    }
}