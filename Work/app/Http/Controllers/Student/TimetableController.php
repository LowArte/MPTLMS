<?php

namespace App\Http\Controllers\Student;

use App\Repositories\ModelRepository\DepartamentRepository;
use App\Repositories\ModelRepository\GroupRepository;
use App\Repositories\ModelRepository\ScheduleRepository;
use App\Repositories\OtherRepository\PanelExtentionRepository;
use Illuminate\Http\Request;

class TimetableController extends BaseController
{
    /**
     * Show the application timetable page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(DepartamentRepository $departamentRepository,
                          GroupRepository $groupRepository,
                          PanelExtentionRepository $panelExtentionRepository,
                          ScheduleRepository $scheduleRepository
                          )
    {
        $departaments = $departamentRepository->getDepartamentsForComboBox();
        $groups = $groupRepository->getGroupsForComboBoxByDepartament($departaments[0]->id);
        $panel_array = $panelExtentionRepository->getPanelForCallSchedule();

        $schedule = $scheduleRepository->getScheduleByGroup($groups[0]->id);

        return view('roles.student.timetable',[
            "panel_array"=>$panel_array,
            "departaments_info"=>array(
                "departaments"=>$departaments,
                "selected_departament"=>$departaments[0]
            ),
            "groups_info"=>array(
                "groups"=>$groups,
                "selected_group"=>$groups[0]
            ),
            'schedule'=>$schedule
        ]);
    }
}