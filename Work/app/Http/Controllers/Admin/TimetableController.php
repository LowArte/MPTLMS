<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DepartamentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\PanelExtentionRepository;
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
                          PanelExtentionRepository $panelExtentionRepository)
    {
        $departaments = $departamentRepository->getDepartamentsForComboBox();
        $groups = $groupRepository->getGroupsForComboBoxByDepartament($departaments[0]->id);
        $panel_array = $panelExtentionRepository->getPanelForCallSchedule();

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
        ]);
    }
}
