<?php

namespace App\Http\Controllers\Admin;

use App\Modifications\Update\UpdateScheduleModification;
use App\Repositories\DepartamentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\PanelExtentionRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\DisciplineRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\UserRepository;
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
                          TeacherRepository $teacherRepository,
                          UserRepository $userRepository)
    {
        $departaments = $departamentRepository->getDepartamentsForComboBox();
        $groups = $groupRepository->getGroupsForComboBoxByDepartament($departaments[0]->id);
        $panel_array = $panelExtentionRepository->getPanelForCallSchedule();

        $schedule = $scheduleRepository->getScheduleByGroup($groups[0]->id);
        $schedule_bild = $scheduleRepository->getScheduleBildByGroup($groups[0]->id);

        $places = $placeRepository->getPlaces();
        $disciplines = $disciplineRepository->getDisciplines();
        $teachers = $teacherRepository->getTeachers();

        $teachersFIO = array();
        for ($i = 0; $i < count($teachers); $i++) {
            $user = $userRepository->getUserFIO($teachers[$i]['user_id']);
            array_push($teachersFIO, ['id' => $user['id'], 'name' => $user['name'] . " " . $user['secName'] . " " . $user['thirdName']]);
        };

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
            'teachers'=>$teachersFIO
        ]);
    }
    /**
     * edit schedule from database
     * @param id schedule id
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
     * Get schedule
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getScheduleBildByGroupId($id, ScheduleRepository $scheduleRepository)
    {
        $schedule = $scheduleRepository->getScheduleBildByGroup($id);
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