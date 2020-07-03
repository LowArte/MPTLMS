<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Update\UpdateScheduleModification;
use App\Repositories\ModelRepository\ScheduleRepository;
use Illuminate\Http\Request;
use Debugbar;

class ScheduleController extends BaseController
{ 
    /**
     * Получение расписания
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getScheduleByGroupId($id, ScheduleRepository $scheduleRepository)
    {
        $schedule = $scheduleRepository->getScheduleByGroup($id);
        return response()->json(compact('schedule'));
    }
    /**
     * Получение чистого расписания с id элементами и для вывода
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getScheduleBildShowByGroupId($id, ScheduleRepository $scheduleRepository)
    {
        $schedule = $scheduleRepository->getScheduleBildShowByGroup($id);
        return response()->json(compact('schedule'));
    }
    /**
     * Получение чистого и общего расписания
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getScheduleBildByGroupId($id, ScheduleRepository $scheduleRepository)
    {
        $schedule = $scheduleRepository->getScheduleBildByGroup($id);
        return response()->json(compact('schedule'));
    }
    /**
     * Получение чистого и общего расписания на день по id препода
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getScheduleBildShowDayByTeacherId($teacher_id, $day, ScheduleRepository $scheduleRepository)
    {
        $schedule = $scheduleRepository->getScheduleBildShowDayByTeacherId($teacher_id, $day);
        return response()->json(compact('schedule'));
    }    

    public function getTeachersForScheduleDay($chisl, $day, ScheduleRepository $scheduleRepository)
    {
        $teachers = $scheduleRepository->getTeachersForScheduleDay($chisl, $day);
        return response()->json(compact('teachers'));
    }
    /**
     * Получение расписания преподавателя
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getScheduleTeacher($teacher_id, ScheduleRepository $scheduleRepository)
    {
        $schedule = $scheduleRepository->getScheduleTeacher($teacher_id);
        return response()->json(compact('schedule'));
    }
    /**
     * Редактирование расписания
     * @param id id расписания
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
    /**
     * Редактирование аудиторного фонда
     * @param id id расписания
     * @return JSON
     */
    public function editClassroom(Request $request, UpdateScheduleModification $updateScheduleModification)
    {
        $data = $request->all();
        $result = $updateScheduleModification->updateScheduleClassroomInDatabase($data);

        if($result)
            return response()->json(["success"=>true]);
        return response()->json(["error"=>"Расписание не сохранено"],400);
    }
}