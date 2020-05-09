<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\ScheduleExamsRepository;
use App\Modifications\Create\CreateScheduleExamModification;
use App\Modifications\Delete\DeleteScheduleExamModification;
use App\Modifications\Update\UpdateScheduleExamModification;

use Illuminate\Http\Request;
use Debugbar;

class ScheduleExamsController extends BaseController
{ 
    /**
     * Получение расписания экзаменов
     *
     * @return \Illuminate\Contracts\Support\Renderable 
     */
    public function getScheduleExams(ScheduleExamsRepository $scheduleExamsRepository, DeleteScheduleExamModification $deleteScheduleExamModification)
    {
        $result = $deleteScheduleExamModification->deleteScheduleExamOldFromDatabase();
        $schedule = $scheduleExamsRepository->getScheduleExams();
        return response()->json(compact('schedule'));
    }   
    
    /**
     * Сохранение расписания экзаменов
     *
     * @return \Illuminate\Contracts\Support\Renderable 
     */
    public function save(Request $request, CreateScheduleExamModification $createScheduleExamModification)
    {
        $data = $request->all();
        $id = $createScheduleExamModification->addScheduleExamToDatabase($data);
        if($id)
            return response()->json(compact("id"),200);
        return response()->json(["error"=>"Расписание не сохранено"],400);
    } 

    /**
     * Редактирование расписания экзаменов
     *
     * @return \Illuminate\Contracts\Support\Renderable 
     */
    public function edit(Request $request, UpdateScheduleExamModification $updateScheduleExamModification)
    {
        $data = $request->all();
        $result = $updateScheduleExamModification->updateScheduleExamInDatabase($data);
        if($result)
            return response()->json(["success"=>true]);
        return response()->json(["error"=>"Расписание не изменено"],400);
    } 

    /**
     * Удаление расписания экзаменов
     *
     * @return \Illuminate\Contracts\Support\Renderable 
     */
    public function delete($id, DeleteScheduleExamModification $deleteScheduleExamModification)
    {
        $result = $deleteScheduleExamModification->deleteScheduleExamFromDatabase($id);
        if($result)
            return response()->json(["success"=>true]);
        return response()->json(["error"=>"Расписание не удалено"],400);
    } 
}