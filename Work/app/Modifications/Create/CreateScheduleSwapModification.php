<?php

namespace App\Modifications\Create;

use App\Models\ScheduleSwap as Model;
use App\Modifications\BaseModification;
use App\Repositories\ModelRepository\DisciplineRepository;
use App\Repositories\ModelRepository\ScheduleRepository;
use App\Repositories\ModelRepository\UserRepository;
use Debugbar;

class CreateScheduleSwapModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function addScheduleSwapToDatabase($request)
    {
        $scheduleswap = new Model();
        $scheduleswap->fill($request);
        $result = $scheduleswap->save();
        if ($result)
            return $scheduleswap->id;
        return  false;
    }

    public function addParsedScheduleSwapToDatabase($request)
    {
        $scheduleRepository = app(ScheduleRepository::class);
        $disciplineRepository = app(DisciplineRepository::class);
        $userRepository = app(UserRepository::class);
        $schedules = $scheduleRepository->getSchedulesWithGroup();
        $disciplines = $disciplineRepository->getDisciplines();
        $teachers = $userRepository->getTeachersFIO();
        $datas = [];
        $result = [];
        foreach ($request as $swapdays) {
            foreach ($swapdays as $swap) {
                preg_match("/[А-яЁ0-9]{1,4}-\d{1,2}-\d{1,2}/u", $swap["group"], $group);
                $schedule = $schedules->where("group.group_name", $group[0])->first();

                $valid = true;
                $teacherValid = true;
                $disciplineValid = true;
                $groupValid = true;

                if ($schedule) {
                    $swapDatas = [];
                    foreach ($swap["swap"] as $swapData) {
                        $teachers_data = [];
                        foreach ($swapData["teacher"] as $teacher) {
                            $teach = $teachers->where("full_name", $teacher)->first();
                            if ($teach) {
                                array_push($teachers_data, $teach->id);
                                continue;
                            }
                            $valid = false;
                            $teacherValid = false;
                            break;
                        }
                        $discipline = $disciplines->where("discipline_name", $swapData["lesson"])->first();
                        if ($discipline) {
                            array_push($swapDatas, [
                                "caselesson" => $swapData["caselesson"],
                                "lesson" => $discipline->id,
                                "teacher" => $teachers_data
                            ]);
                            continue;
                        }
                        $valid = false;
                        $disciplineValid = false;
                        break;
                    }

                    if ($valid) {
                        $data = [
                            "schedule_id" => $schedule->id,
                            "swap_date" => $swap["swap_date"],
                            "swap" => $swapDatas
                        ];
                        array_push($datas, $data);
                    }
                } 
                else 
                {
                    $groupValid = false;
                    $valid = false;
                }
                $result[$swap["group"]]["added"] = $valid;
                $result[$swap["group"]]["teacher"] = $teacherValid;
                $result[$swap["group"]]["discipline"] = $disciplineValid;
                $result[$swap["group"]]["group"] = $groupValid;
            }
        }
        Debugbar::info($datas);
        // Model::insert($datas);
        return $result;
    }
}
