<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class ScheduleSeeder extends Seeder
{
    /**
     * Формирования дополнительных данных по расписанию
     *
     * @return void
     */
    public function run()
    {
        $les = array('TeacherChisl' => [1], 'LessonChisl' => [1], 'chisl' => true, 'TeacherZnam' => [1], 'LessonZnam' => [2], 'classroom' =>'');
        $lessons = array($les);
        $days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');

        foreach (Group::get() as $group) 
        {
            if ($group->haveParent()) {
                $rasp = array();
                foreach ($days as $key => $value) {
                    $lesons = array('Place' => rand(1, 2), '1' => $lessons[rand(0, count($lessons) - 1)], '2' => $lessons[rand(0, count($lessons) - 1)], '3' => $lessons[rand(0, count($lessons) - 1)], '4' => $lessons[rand(0, count($lessons) - 1)], '5' => $lessons[rand(0, count($lessons) - 1)], '6' => $lessons[rand(0, count($lessons) - 1)], '7' => $lessons[rand(0, count($lessons) - 1)]); //Формат дня
                    $rasp[$value] = $lesons;
                }
                // Формат недели
                DB::table("schedules")->insert(array('schedule' => json_encode($rasp), 'group_id' => $group['id']));
            }
        }
    }
}
