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
        $schedule_bild = $scheduleRepository->getScheduleBildByGroup($groups[0]->id);
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
            'schedule'=>$schedule,
            'schedule_bild'=>$schedule_bild
        ]);
    }
    
}