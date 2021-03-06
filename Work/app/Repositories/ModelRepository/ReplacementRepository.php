<?php

namespace App\Repositories\ModelRepository;

use App\Models\ScheduleSwap as Model;
use Debugbar;

class ReplacementRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }
    /** 
     * Получение всех замен
     * @return Illuminate\Database\Eloquent\Collection
    */
    public function getReplacements()
    {
        $teachersRepository = app(TeacherRepository::class);
        $teachers = $teachersRepository->getTeachersWithFio();

        $disciplineRepository = app(DisciplineBufferRepository::class);
        $disciplines = $disciplineRepository->getDisciplineBufferRepositoryDataLast();
        
        $result = $this->startCondition()
        ->join('schedules', 'schedule_swaps.schedule_id', '=', 'schedules.id')
        ->join('groups', 'schedules.group_id', '=', 'groups.id')
        ->orderBy('groups.id', 'asc')
        ->selectRaw("schedule_swaps.id, schedule_swaps.swap_date, schedule_swaps.swap, group_name, schedules.group_id")
        ->orderBy('swap_date', 'desc')
        ->toBase()->get();
        foreach($result as $item)
        {
            $item->swap = json_decode($item->swap);
            if(count((array)$item->swap->lesson)!=0){
                for($i=0;$i<count((array)$item->swap->lesson);$i++){
                    $foundDiscipline = $disciplines->where("id", $item->swap->lesson[$i])->first();
                    if($foundDiscipline)
                        $item->swap->lesson[$i] =  $foundDiscipline['discip_name'];
                }
                $item->swap->teacher_name = $item->swap->oldteacher;

                for($i=0;$i<count((array)$item->swap->teacher);$i++){
                    $foundTeacher = $teachers->where("id",$item->swap->teacher[$i])->first()->fullFio;                   
                    $item->swap->teacher_name[$i] =  $foundTeacher;
                }  
            }

            if(count((array)$item->swap->oldlesson)!=0){
                for($i=0;$i<count((array)$item->swap->oldlesson);$i++){
                    $foundDiscipline = $disciplines->where("id", $item->swap->oldlesson[$i])->first();
                    if($foundDiscipline)
                        $item->swap->oldlesson[$i] =  $foundDiscipline['discip_name'];
                }
                $item->swap->oldteacher_name = $item->swap->oldteacher;

                for($i=0;$i<count((array)$item->swap->oldteacher);$i++){
                    $foundTeacher = $teachers->where("id",$item->swap->oldteacher[$i])->first()->fullFio;                   
                    $item->swap->oldteacher_name[$i] =  $foundTeacher;
                }  
            }
            $item->swap = json_encode($item->swap);
        }
        return $result;
    }

    //Проверка замен по Id преподавателя
    public function checkTeacherReplacement($teacher_id)
    {
        $check = false;
        $column = ['swap'];
        $result = $this->startCondition()
        ->select($column)
        ->toBase()
        ->get();

        foreach($result as $item)
        {
            $item->swap = json_decode($item->swap);
            foreach ($item->swap->teacher as $teacher) 
            {
                if($teacher == $teacher_id)
                    $check = true;
            }

            foreach ($item->swap->oldteacher as $teacher) 
            {
                if($teacher == $teacher_id)
                    $check = true;
            }
        }
        return $check;
    }
}