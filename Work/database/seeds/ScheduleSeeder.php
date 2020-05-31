<?php

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\User;
use App\Models\Discipline;

class ScheduleSeeder extends Seeder
{
    public function getLesson($teachers)
    {
        $arr = array('TeacherChisl' => [$teachers[rand(0, count($teachers)-1)]->id], 
        'LessonChisl' => [rand(1,20)], 
        'chisl' => rand(0,1), 
        'TeacherZnam' => [$teachers[rand(0, count($teachers)-1)]->id], 
        'LessonZnam' => [rand(1,20)], 
        'classroom' =>'');
        return $arr;
    }
    /**
     * Формирования дополнительных данных по расписанию
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::where("post_id", 3)->get();
        //$les = array('TeacherChisl' => [1], 'LessonChisl' => [1], 'chisl' => true, 'TeacherZnam' => [1], 'LessonZnam' => [2], 'classroom' =>'');
        //$lessons = array($les);
        $days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');

        foreach (Group::get() as $group) 
        {
            if ($group->haveParent()) {
                $rasp = array();
                foreach ($days as $key => $value) {
                    $lesons = array('Place' => rand(1, 2), 
                    '1' => $this->getLesson($teachers), 
                    '2' => $this->getLesson($teachers), 
                    '3' => $this->getLesson($teachers), 
                    '4' => $this->getLesson($teachers), 
                    '5' => $this->getLesson($teachers), 
                    '6' => $this->getLesson($teachers), 
                    '7' => $this->getLesson($teachers)); //Формат дня
                    $rasp[$value] = $lesons;
                }
                // Формат недели
                DB::table("schedules")->insert(array('schedule' => json_encode($rasp), 'group_id' => $group['id']));
            }
        }
    }
}
