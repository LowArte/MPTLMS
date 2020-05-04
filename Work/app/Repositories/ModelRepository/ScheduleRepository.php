<?php

namespace App\Repositories\ModelRepository;

use App\Models\Schedule as Model;
use App\Models\Journal as JournalModel;
use Composer\IO\NullIO;
use phpDocumentor\Reflection\Types\Null_;
use Debugbar;

class ScheduleRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getScheduleByGroup($group_id, $teachers = null, $disciplines = null)
    {
        $columns = ['schedule'];
        $callScheduleRepository = app(CallScheduleRepository::class);
        $call = $callScheduleRepository->getCallScheduleForSchedule();

        if ($teachers == null) {
            $teachersRepository = app(TeacherRepository::class);
            $teachers = $teachersRepository->getTeachersWithFio();
        }

        if ($disciplines == null) {
            $disciplineRepository = app(DisciplineRepository::class);
            $disciplines = $disciplineRepository->getDisciplines();
        }
        $schedule = json_decode($this->startCondition()->select($columns)->where('group_id', $group_id)->toBase()->first()->schedule);
        foreach ((array) $schedule as $days => $row) {
            $current = $call->where('place.id', $schedule->{$days}->Place)->first();
            $schedule->{$days}->Place = $current['place'];
            foreach ((array) $current['schedule'] as $lessons => $row2) {
                $schedule->{$days}->{$lessons}->time = $current['schedule']->{$lessons};

                if (count($schedule->{$days}->{$lessons}->LessonChisl) != 0) {
                    for ($i = 0; $i < count($schedule->{$days}->{$lessons}->LessonChisl); $i++) {
                        $foundDiscipline = $disciplines->where("id", $schedule->{$days}->{$lessons}->LessonChisl[$i])->first()->discipline_name;
                        $schedule->{$days}->{$lessons}->LessonChisl[$i] =  $foundDiscipline;
                    }

                    for ($i = 0; $i < count($schedule->{$days}->{$lessons}->TeacherChisl); $i++) {
                        $foundTeacher = $teachers->where("id", $schedule->{$days}->{$lessons}->TeacherChisl[$i])->first()->fullFio;
                        $schedule->{$days}->{$lessons}->TeacherChisl[$i] =  $foundTeacher;
                    }
                }
                if (count($schedule->{$days}->{$lessons}->LessonZnam) != 0) {
                    for ($i = 0; $i < count($schedule->{$days}->{$lessons}->LessonZnam); $i++) {
                        $foundDiscipline = $disciplines->where("id", $schedule->{$days}->{$lessons}->LessonZnam[$i])->first()->discipline_name;
                        $schedule->{$days}->{$lessons}->LessonZnam[$i] =  $foundDiscipline;
                    }

                    for ($i = 0; $i < count($schedule->{$days}->{$lessons}->TeacherZnam); $i++) {
                        $foundTeacher = $teachers->where("id", $schedule->{$days}->{$lessons}->TeacherZnam[$i])->first()->fullFio;
                        $schedule->{$days}->{$lessons}->TeacherZnam[$i] =  $foundTeacher;
                    }
                }
            }
        }
        return $schedule;
    }

    public function getScheduleBildShowDayByTeacherId($teacher_id, $day)
    {
        //Получение данных
        $columns = ['schedules.id', 'schedule', 'groups.id as group_id', 'groups.group_name'];
        $result = $this->startCondition()
            ->join('groups', 'schedules.group_id', '=', 'groups.id')
            ->select($columns)
            ->limit(7)
            ->toBase()
            ->get();
        $arrayScheduleDay = [];
        //Прохождение по полученным расписаниям
        foreach ($result as $schedule) {
            $schedule->schedule = json_decode($schedule->schedule);
            $checkTeacher = false;
            //Проходение по парам
            foreach ($schedule->schedule->$day as $keyLesson => $lesson) {
                if ($keyLesson != 'Place') {
                    //Прохождение по преподователям по числителю
                    foreach ($lesson->TeacherChisl as $keyTeacher => $teacher)
                        if ($teacher == $teacher_id)
                            $checkTeacher = true;

                    if ($lesson->chisl)
                        //Прохождение по преподователям по знаменателю
                        foreach ($lesson->TeacherZnam as $keyTeacher => $teacher)
                            if ($teacher == $teacher_id)
                                $checkTeacher = true;
                }
            }

            if ($checkTeacher) {
                array_push(
                    $arrayScheduleDay,
                    [
                        'group_name' => $schedule->group_name,
                        'schedule_id' => $schedule->id,
                        'bild' => $schedule->schedule->$day,
                        'show' => $this->getScheduleByGroup($schedule->group_id)->$day
                    ]
                );
            }
        }
        return $arrayScheduleDay;
    }
    //Получение преподов на определённый день
    public function getTeachersForScheduleDay($chsil, $day)
    {
        //Получение данных
        $columns = ['schedules.id', 'schedule', 'groups.group_name'];
        $result = $this->startCondition()
            ->join('groups', 'schedules.group_id', '=', 'groups.id')
            ->select($columns)
            ->toBase()
            ->get();
        $arrayTeachers = [];
        foreach ($result as $schedule) {
            $schedule->schedule = json_decode($schedule->schedule);
            //Проходение по парам
            foreach ($schedule->schedule->$day as $keyLesson => $lesson) {
                if ($keyLesson != 'Place') {
                    if ($chsil == 0) {
                        //Прохождение по преподователям по числителю
                        foreach ($lesson->TeacherChisl as $keyTeacher => $teacher) {
                            if (!in_array($teacher, $arrayTeachers, true)) {
                                array_push($arrayTeachers, $teacher);
                            }
                        }
                    } else {
                        //Прохождение по преподователям по знаменателю
                        foreach ($lesson->TeacherZnam as $keyTeacher => $teacher) {
                            if (!in_array($teacher, $arrayTeachers, true)) {
                                array_push($arrayTeachers, $teacher);
                            }
                        }
                    }
                }
            }
        }

        $teachersRepository = app(TeacherRepository::class);
        $teachers = $teachersRepository->getTeachersWithFio();
        $result = [];
        foreach ($arrayTeachers as $value) {
            Debugbar::info($value);
            $foundTeacher = $teachers->where("id", $value)->first()->fullFio;
            array_push($result, ['id' => $value, 'fio' => $foundTeacher]);
        }

        return $result;
    }

    //Получение расписания для преподавателя
    public function getScheduleTeacher($teacher_id)
    {
        //$journal = JournalModel::select('group_id', 'association')->get();

        //Получение данных
        $columns = ['schedule', 'groups.group_name'];
        $result = $this->startCondition()
            ->join('groups', 'schedules.group_id', '=', 'groups.id')
            ->select($columns)
            ->toBase()
            ->limit(1)
            ->get();
        //Каркас для формирования расписания преподавателя
        $days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
        $lessons = array('GroupChisl' => [], 'LessonChisl' => [], 'chisl' => false, 'GroupZnam' => [], 'LessonZnam' => [], 'TimeChisl' => [], 'TimeZnam' => [], 'PlaceChisl' => [], 'PlaceZnam' => [], 'Classroom' => []);
        $schedule_teacher = array();
        foreach ($days as $key => $value) {
            $lesons = array('1' => $lessons, '2' => $lessons, '3' => $lessons, '4' => $lessons, '5' => $lessons, '6' => $lessons, '7' => $lessons);
            $schedule_teacher[$value] = $lesons;
        }
        //Замена id на название дисциплины
        $disciplineRepository = app(DisciplineRepository::class);
        $disciplines = $disciplineRepository->getDisciplines();

        //Получение расписания звонков
        $callScheduleRepository = app(CallScheduleRepository::class);
        $call = $callScheduleRepository->getCallScheduleForSchedule();

        //Формирование расписания
        //Прохождение по полученным расписаниям
        foreach ($result as $schedule) {
            $schedule->schedule = json_decode($schedule->schedule);
            //Прохождение по дням
            foreach ($days as $day) {
                //Проходение по парам
                foreach ($schedule->schedule->$day as $keyLesson => $lesson) {
                    $current = $call->where('place.id', $schedule->schedule->$day->Place)->first();
                    unset($current['place']->info);
                    if ($keyLesson != 'Place') {
                        $checkTeacher = false;
                        //Прохождение по преподователям по числителю
                        foreach ($lesson->TeacherChisl as $keyTeacher => $teacher) {
                            if ($teacher == $teacher_id) {
                                $checkTeacher = true;
                                array_push($schedule_teacher[$day][$keyLesson]['GroupChisl'], $schedule->group_name);
                                $foundDiscipline = $disciplines->where("id", $lesson->LessonChisl[$keyTeacher])->first()->discipline_name;
                                array_push($schedule_teacher[$day][$keyLesson]['LessonChisl'], $foundDiscipline);
                                array_push($schedule_teacher[$day][$keyLesson]['PlaceChisl'], $current['place']->place_name);
                                array_push($schedule_teacher[$day][$keyLesson]['TimeChisl'], $current['schedule']->$keyLesson);
                            }
                            break;
                        }

                        if ($lesson->chisl) {
                            //Прохождение по преподователям по знаменателю
                            foreach ($lesson->TeacherZnam as $keyTeacher => $teacher) {
                                if ($teacher == $teacher_id) {
                                    $checkTeacher = true;
                                    $schedule_teacher[$day][$keyLesson]['chisl'] = true;
                                    array_push($schedule_teacher[$day][$keyLesson]['GroupZnam'], $schedule->group_name);
                                    $foundDiscipline = $disciplines->where("id", $lesson->LessonChisl[$keyTeacher])->first()->discipline_name;
                                    array_push($schedule_teacher[$day][$keyLesson]['LessonZnam'], $foundDiscipline);
                                    array_push($schedule_teacher[$day][$keyLesson]['PlaceZnam'], $current['place']->place_name);
                                    array_push($schedule_teacher[$day][$keyLesson]['TimeZnam'], $current['schedule']->$keyLesson);
                                }
                                break;
                            }
                        }
                        array_push($schedule_teacher[$day][$keyLesson]['Classroom'], $lesson->classroom);
                    }
                }
            }
        }
        return $schedule_teacher;
    }

    public function getScheduleBildByGroup($group_id)
    {
        $columns = ['schedule'];
        $result = json_decode($this->startCondition()->select($columns)->where('group_id', $group_id)->toBase()->first()->schedule);
        return $result;
    }

    public function getScheduleByGroupId($group_id)
    {
        $columns = ['id'];
        $result = $this->startCondition()->select($columns)->where('group_id', $group_id)->first();
        return $result;
    }

    public function getScheduleIdByGroup($group_id)
    {
        $columns = ['id'];
        $result = $this->startCondition()->select($columns)->where('group_id', $group_id)->toBase()->first()->id;
        $result = $this->startCondition()->select($columns)->where('group_id', $group_id)->first()->id;
        return $result;
    }

    public function getSchedulesWithGroup()
    {
        $columns = ['id', 'group_id'];
        $result = $this->startCondition()->with("group:id,group_name")->select($columns)->get();
        return $result;
    }
}
