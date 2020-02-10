<?php

namespace App\Http\Controllers\Admin;

use App\Modifications\Create\CreateReplacementModification;
use App\Modifications\Delete\DeleteReplacementModification;
use App\Repositories\ModelRepository\DepartamentRepository;
use App\Repositories\ModelRepository\DisciplineRepository;
use App\Repositories\ModelRepository\GroupRepository;
use App\Repositories\ModelRepository\ReplacementRepository;
use App\Repositories\ModelRepository\ScheduleRepository;
use App\Repositories\ModelRepository\TeacherRepository;
use Illuminate\Http\Request;

class ReplacementController extends BaseController
{
    /**
     * Show the application timetable page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(DepartamentRepository $departamentRepository,
                          GroupRepository $groupRepository,
                          ScheduleRepository $scheduleRepository,
                          DisciplineRepository $disciplineRepository,
                          TeacherRepository $teacherRepository,
                          ReplacementRepository $replacementRepository)
    {
        $departaments = $departamentRepository->getDepartamentsForComboBox();
        $groups = $groupRepository->getGroupsForComboBoxByDepartament($departaments[0]->id);
        $disciplines = $disciplineRepository->getDisciplines();
        $teachers = $teacherRepository->getTeachersWithFio();
        $schedule = $scheduleRepository->getScheduleByGroup($groups[0]->id);
        $replacements = $replacementRepository->getReplacements([
            ["swap_date", '=', date("Y-m-d")],
            ["schedule_id", '=', $scheduleRepository->getScheduleIdByGroup($groups[0]->id)],
        ]);

        return view('roles.admin.replacement',[
            "departaments_info"=>array(
                "departaments"=>$departaments,
                "selected_departament"=>$departaments[0]
            ),
            "groups_info"=>array(
                "groups"=>$groups,
                "selected_group"=>$groups[0]
            ),
            'replacements'=>$replacements,
            'disciplines'=>$disciplines,
            'teachers'=>$teachers,
            'schedule'=>$schedule
        ]);
    }

    /**
     * save replacement from database
     * @param id schedule id
     * @return JSON
     */
    public function save($id, Request $request, ScheduleRepository $scheduleRepository, CreateReplacementModification $createReplacementModification)
    {
        $scheduleId = $scheduleRepository->getScheduleIdByGroup($id);
        $result = $createReplacementModification->addReplacementToDatabase($request, $scheduleId);

        if($result)
            return response()->json(["success"=>true]);
        return response()->json(["error"=>"Замена не сохранена"],400);
    }

    /**
     * delete replacement from database
     * @param id schedule id
     * @return JSON
     */
    public function delete($id, Request $request, DeleteReplacementModification $deleteReplacementModification)
    {
        $result = $deleteReplacementModification->deleteReplacementFromDatabase($id);

        if($result)
        {
            return response()->json(["success"=>true]);
        }
        return response()->json(["error"=>"Замена не удалена"],400);
    }

    /**
     * Get replacements by group and data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function replacementsByGroupByDate($id, Request $request, ReplacementRepository $replacementRepository, ScheduleRepository $scheduleRepository)
    {
        $replacements = $replacementRepository->getReplacements([
            ["swap_date", '=', $request['date']],
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
    public function replacementsByDate(Request $request, ReplacementRepository $replacementRepository)
    {
        $replacements = $replacementRepository->getReplacements([["swap_date", '=', $request['date']]]);
        return response()->json(compact('replacements'));
    }

    /**
     * Get replacements by data
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function replacements(ReplacementRepository $replacementRepository)
    {
        $replacements = $replacementRepository->getReplacements([]);
        return response()->json(compact('replacements'));
    }

     /**
     * Get groups
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function groupByDepartamentId($id, GroupRepository $groupRepository)
    {
        $groups = $groupRepository->getGroupsForComboBoxByDepartament($id);
        return response()->json(array(
            "groups_info"=>array(
                "groups"=>$groups,
                "selected_group"=>$groups[0]
            ),
        ));
    }

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
}