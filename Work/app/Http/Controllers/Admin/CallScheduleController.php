<?php

namespace App\Http\Controllers\Admin;

use App\Modifications\Update\UpdateCallScheduleModification;
use App\Repositories\CallScheduleRepository;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;

class CallScheduleController extends BaseController
{
    /**
     * Show the application call schedule page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CallScheduleRepository $callScheduleRepository, PlaceRepository $placeRepository)
    {
        $timeTable = $callScheduleRepository->getCallSchedule();
        $places = $placeRepository->getPlaces();
        return view('roles.admin.call-schedule',compact('timeTable', 'places'));
    }
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
