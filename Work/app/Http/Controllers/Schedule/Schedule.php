<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departament;
use App\Models\Group;
use Illuminate\Support\Facades\Storage;

class Schedule extends Controller
{
    /*
        Функция get запроса для получения рассписания
    */
    public function init()
    {
        $exists = Storage::disk('local')->has('schedule/schedule.json');    
        if($exists){
            $contents = Storage::get('schedule/schedule.json');
        }
        else{
            $contents = $this->generateDefaultJSON();
            Storage::put('schedule/schedule.json',$contents);
        }
        return response()->json(json_decode($contents),200);
    }
    /*
        Генерация стандартного json файла 
        Файл находится в папке storage/schedule/schedule.json
        В данной файле находится рассписание в формате json
    */
    private function generateDefaultJSON()
    {
        $contents = array();
        $les = array('Teacher'=>"",'Lesson'=>"");//Формат одной пары
        $lesons = array('1'=>$les,'2'=>$les,'3'=>$les,'4'=>$les,'5'=>$les,'6'=>$les,'7'=>$les);//Формат дня
        $rasp = array('Place'=>"",'Понедельник'=>$lesons,'Вторник'=>$lesons,'Среда'=>$lesons,'Четверг'=>$lesons,'Пятница'=>$lesons,'Суббота'=>$lesons); // Формат недели
        foreach(Departament::get() as $departament){//Для всех специальностей
            $contents[$departament['dep_name']] = array();
            foreach(Group::where('departaments_id',$departament['id'])->get() as $group){   //Для каждой группы      
                $contents[$departament['dep_name']][$group['group_name']] = $rasp;
            }
        }
        return json_encode($contents);
    }
    /*
        Функция post запроса для сохранения рассписания
        Рассписание находится в поле schedule
    */
    public function save(Request $request){
        Storage::put('schedule/schedule.json',$request->schedule);
        return response()->json([
            'success' => true], 200);
    }
}
