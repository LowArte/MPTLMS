<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateScheduleSwapModification;
use App\Modifications\Delete\DeleteScheduleSwapModification;
use App\Modifications\Update\UpdateScheduleSwapModification;
use App\Repositories\ModelRepository\ScheduleSwapRepository;
use Illuminate\Http\Request;

use Debugbar;
class ScheduleSwapController extends BaseController
{ 
    /**
     * get ScheduleSwapController from database
     * @return JSON
     */
    public function getScheduleSwap(ScheduleSwapRepository $scheduleswapRepository)
    {
        $scheduleswapRepository = $scheduleswapRepository->getScheduleSwap();
        return response()->json(compact('scheduleswapRepository'));
    }

    public function save(Request $request,CreateScheduleSwapModification $createScheduleSwapModification){
        $data = $request->all();
        $id = $createScheduleSwapModification->addScheduleSwapToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateScheduleSwapModification $updateScheduleSwapModification){
        $data = $request->all();
        $result = $updateScheduleSwapModification->updateScheduleSwapInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteScheduleSwapModification $deleteScheduleSwapModification){
        $result = $deleteScheduleSwapModification->deleteScheduleSwapFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}