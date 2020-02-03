<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DepartamentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\PanelExtentionRepository;
use App\Repositories\ScheduleRepository;

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
                          ScheduleRepository $scheduleRepository)
    {
        $departaments = $departamentRepository->getDepartamentsForComboBox();
        $groups = $groupRepository->getGroupsForComboBoxByDepartament($departaments[0]->id);
        $panel_array = $panelExtentionRepository->getPanelForCallSchedule();
        $schedule = $scheduleRepository->getScheduleByGroup($groups[0]->id);
        return view('roles.admin.timetable',[
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
}