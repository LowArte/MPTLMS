<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ModelRepository\DepartamentRepository;
use App\Repositories\ModelRepository\DisciplineRepository;
use App\Repositories\ModelRepository\GroupRepository;
use App\Repositories\ModelRepository\PlaceRepository;
use App\Repositories\ModelRepository\ScheduleRepository;
use App\Repositories\ModelRepository\TeacherRepository;
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
                          ScheduleRepository $scheduleRepository,
                          PlaceRepository $placeRepository,
                          DisciplineRepository $disciplineRepository,
                          TeacherRepository $teacherRepository
                          )
    {
        $departaments = $departamentRepository->getDepartamentsForComboBox();
        $groups = $groupRepository->getGroupsForComboBoxByDepartament($departaments[0]->id);
        $panel_array = $panelExtentionRepository->getPanelForCallSchedule();

        $places = $placeRepository->getPlaces();
        $disciplines = $disciplineRepository->getDisciplines();
        $teachers = $teacherRepository->getTeachersWithFio();

        $schedule_bild = $scheduleRepository->getScheduleBildByGroup($groups[0]->id,$teachers,$disciplines);      
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
            'schedule'=>$schedule,
            'schedule_bild'=>$schedule_bild,
            'places'=>$places,
            'disciplines'=>$disciplines,
            'teachers'=>$teachers
        ]);
    }
}