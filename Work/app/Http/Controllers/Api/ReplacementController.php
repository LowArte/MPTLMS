<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateReplacementModification;
use App\Modifications\Delete\DeleteReplacementModification;
use App\Repositories\ModelRepository\ReplacementRepository;
use App\Repositories\ModelRepository\ScheduleRepository;
use Illuminate\Http\Request;

class ReplacementController extends BaseController
{ 
    /**
     * Получение замен
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getReplacements(ReplacementRepository $replacementRepository, DeleteReplacementModification $deleteReplacementModification)
    {
        $result = $deleteReplacementModification->deleteReplacementOldFromDatabase();
        $replacements = $replacementRepository->getReplacements();
        return response()->json(compact('replacements'));
    }

    //Проверка на замену для преподавателя
    public function getCheckTeacherReplacement($teacher_id, ReplacementRepository $replacementRepository)
    {
        $check = $replacementRepository->checkTeacherReplacement($teacher_id);
        return response()->json(compact('check'));
    }

    /**
     * Сохранение замены
     * @param id schedule id
     * @return JSON
     */
    public function save($id, $date, Request $request, ScheduleRepository $scheduleRepository, CreateReplacementModification $createReplacementModification)
    {
        $scheduleId = $scheduleRepository->getScheduleIdByGroup($id);
        $result = $createReplacementModification->addReplacementToDatabase($request['replacement'], $date, $scheduleId);

        if($result)
            return response()->json(["success"=>true]);
        return response()->json(["error"=>"Замена не сохранена"],400);
    }
   
    /**
     * Удаление замены
     * @param id schedule id
     * @return JSON
     */
    public function delete($id, DeleteReplacementModification $deleteReplacementModification)
    {
        $result = $deleteReplacementModification->deleteReplacementFromDatabase($id);

        if($result)
        {
            return response()->json(["success"=>true]);
        }
        return response()->json(["error"=>"Замена не удалена"],400);
    }
}