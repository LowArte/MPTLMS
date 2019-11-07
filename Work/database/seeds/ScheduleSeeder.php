<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $les = array('Teacher'=>null,'Lesson'=>null);//Формат одной пары
        $lesons = array('Place'=>"",'1'=>$les,'2'=>$les,'3'=>$les,'4'=>$les,'5'=>$les,'6'=>$les,'7'=>$les);//Формат дня
        $rasp = array('Понедельник'=>$lesons,'Вторник'=>$lesons,'Среда'=>$lesons,'Четверг'=>$lesons,'Пятница'=>$lesons,'Суббота'=>$lesons);// Формат недели
        foreach (Group::get() as $group) {  
            DB::table("schedules")->insert(array('schedule'=>json_encode($rasp),'group_id'=>$group['id']));
        }
    }
}
