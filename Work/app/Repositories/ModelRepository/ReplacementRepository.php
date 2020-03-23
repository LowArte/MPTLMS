<?php

namespace App\Repositories\ModelRepository;

use App\Models\ScheduleSwap as Model;

class ReplacementRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }
    /** 
     * get all replacements
     * @return Illuminate\Database\Eloquent\Collection
    */
    public function getReplacements($where, $teachers=null, $disciplines=null)
    {
        if($teachers == null)
        {
            $teachersRepository = app(TeacherRepository::class);
            $teachers = $teachersRepository->getTeachersWithFio();
        }

        if($disciplines == null)
        {
            $disciplineRepository = app(DisciplineRepository::class);
            $disciplines = $disciplineRepository->getDisciplines();
        }

        $result = $this->startCondition()
        ->where($where)
        ->join('schedules', 'schedule_swaps.schedule_id', '=', 'schedules.id')
        ->join('groups', 'schedules.group_id', '=', 'groups.id')
        ->orderBy('groups.id', 'asc')
        ->selectRaw("schedule_swaps.id, schedule_swaps.swap_date, schedule_swaps.swap, schedule_swaps.created_at, CONCAT(group_name, '-', group_number, '-', group_year) as group_name")
        ->orderBy('swap_date', 'desc')
        ->toBase()->get();
        foreach($result as $item)
        {
            $item->swap = json_decode($item->swap);
            if(count((array)$item->swap->lesson)!=0){
                for($i=0;$i<count((array)$item->swap->lesson);$i++){
                    $foundDiscipline = $disciplines->where("id",$item->swap->lesson[$i])->first()->discipline_name;
                    $item->swap->lesson[$i] =  $foundDiscipline;
                }

                for($i=0;$i<count((array)$item->swap->teacher);$i++){
                    $foundTeacher = $teachers->where("id",$item->swap->teacher[$i])->first()->fullFio;                   
                    $item->swap->teacher[$i] =  $foundTeacher;
                }  
            }

            if(count((array)$item->swap->oldlesson)!=0){
                for($i=0;$i<count((array)$item->swap->oldlesson);$i++){
                    $foundDiscipline = $disciplines->where("id",$item->swap->oldlesson[$i])->first()->discipline_name;
                    $item->swap->oldlesson[$i] =  $foundDiscipline;
                }

                for($i=0;$i<count((array)$item->swap->oldteacher);$i++){
                    $foundTeacher = $teachers->where("id",$item->swap->oldteacher[$i])->first()->fullFio;                   
                    $item->swap->oldteacher[$i] =  $foundTeacher;
                }  
            }
            $item->swap = json_encode($item->swap);
        }
        return $result;
    }
}