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
        /*
        $les = array('Teacher'=>null,'Lesson'=>null);//Формат одной пары
        $les0 = array('Teacher'=>'Горбунов Антон Дмитриевич','Lesson'=>'Операционные системы');//Формат одной не пустой пары
        $les1 = array('Teacher'=>array('Горбунов Антон Дмитриевич', 'Токарчук Александр Сергеевич'),'Lesson'=>array('Операционные системы', 'Информационные системы и технологии'));//Формат числителя и знаменателя пары
        $les2 = array('Teacher'=>array(array('Горбунов Антон Дмитриевич', 'Токарчук Александр Сергеевич')),'Lesson'=>array(array('Информационные системы и технологии','Информационные системы и технологии')));//Формат сдвоенных пары
        $les3 = array('Teacher'=>array(array('Горбунов Антон Дмитриевич', 'Токарчук Александр Сергеевич'), array('Токарчук Александр Сергеевич', 'Горбунов Антон Дмитриевич')),'Lesson'=>array(array('Информационные системы и технологии','Информационные системы и технологии'), array('Информационные системы и технологии','Информационные системы и технологии')));//Формат сдвоенных не пустых пар
        $les4 = array('Teacher'=>array(array('Горбунов Антон Дмитриевич', 'Токарчук Александр Сергеевич'), 'Токарчук Александр Сергеевич'),'Lesson'=>array(array('Информационные системы и технологии','Информационные системы и технологии'), 'Информационные системы и технологии'));//Формат сдвоенных не пустых пар
        $les5 = array('Teacher'=>array(null, 'Токарчук Александр Сергеевич'),'Lesson'=>array(null, 'Информационные системы и технологии'));//Формат числителя и знаменателя пары
        $les6 = array('Teacher'=>array('Горбунов Антон Дмитриевич', null),'Lesson'=>array('Операционные системы', null));//Формат числителя и знаменателя пары

        $lessons = array($les,$les0,$les1,$les2,$les3,$les4,$les5,$les6);
        $days = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота');
        */
        $les = array('TeacherChisl'=>[],'LessonChisl'=>[], 'chisl'=>false, 'TeacherZnam'=>null,'LessonZnam'=>null);
        $lessons = array($les);
        $days = array('Понедельник','Вторник','Среда','Четверг','Пятница','Суббота');
    
        foreach (Group::get() as $group) {  
            $rasp = array();
            foreach ($days as $key => $value) {
                $lesons = array('Place'=>rand(1,2), '1'=>$lessons[rand(0,count($lessons)-1)],'2'=>$lessons[rand(0,count($lessons)-1)],'3'=>$lessons[rand(0,count($lessons)-1)],'4'=>$lessons[rand(0,count($lessons)-1)],'5'=>$lessons[rand(0,count($lessons)-1)],'6'=>$lessons[rand(0,count($lessons)-1)],'7'=>$lessons[rand(0,count($lessons)-1)]);//Формат дня
                $rasp[$value]=$lesons;
            }
            // Формат недели
            DB::table("schedules")->insert(array('schedule'=>json_encode($rasp),'group_id'=>$group['id']));
        }
    }
}
