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
     * Get replacements by group and data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function replacementsByGroupByDate($id, $date, ReplacementRepository $replacementRepository, ScheduleRepository $scheduleRepository)
    {
        $replacements = $replacementRepository->getReplacements([
            ["swap_date", '=', $date],
            ["schedule_id", '=', $scheduleRepository->getScheduleIdByGroup($id)],
        ]);
        return response()->json(compact('replacements'));
    }

    /**
     * Get replacements by group
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function replacementsByGroup($id, ReplacementRepository $replacementRepository, ScheduleRepository $scheduleRepository)
    {
        $replacements = $replacementRepository->getReplacements([["schedule_id", '=', $scheduleRepository->getScheduleIdByGroup($id)]]);
        return response()->json(compact('replacements'));
    }

    /**
     * Get replacements by data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function replacementsByDate($date, ReplacementRepository $replacementRepository)
    {
        $replacements = $replacementRepository->getReplacements([["swap_date", '=', $date]]);
        return response()->json(compact('replacements'));
    }

    /**
     * Get replacements
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function replacements(ReplacementRepository $replacementRepository)
    {
        $replacements = $replacementRepository->getReplacements([]);
        return response()->json(compact('replacements'));
    }

        /**
     * save replacement from database
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
     * delete replacement from database
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