<?php

namespace App\Repositories\ModelRepository;

use App\Models\ScheduleExams as Model;
use Illuminate\Database\Eloquent\Collection;

class ScheduleExamsRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }
    /** 
     * Получение данных об расписании экзамнов
     * @return Illuminate\Database\Eloquent\Collection
    */
    public function getScheduleExams()
    {
        $columns = ['schedule_exams.id','date', 'schedule_exams.info', 'group_id', 'place_id', 'groups.group_name', 'places.place_name'];
        $result = $this->startCondition()
        ->join('groups', 'group_id', '=', 'groups.id')
        ->join('places', 'place_id', '=', 'places.id')
        ->select($columns)->toBase()->get();

        $teachersRepository = app(TeacherRepository::class);
        $teachers = $teachersRepository->getTeachersWithFio();

        foreach ($result as $value)
        {
            $value->info = json_decode($value->info);
            for($i=0;$i<count($value->info->teacher);$i++)
            {
                $foundTeacher = $teachers->where("id",$value->info->teacher[$i])->first()->fullFio;  
                $value->info->teachersFullName[$i] = $foundTeacher;
            }  
        } 
        return $result;
    }
}