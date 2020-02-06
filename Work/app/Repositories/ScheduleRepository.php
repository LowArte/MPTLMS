<?php

namespace App\Repositories;

use App\Models\Schedule as Model;
use Composer\IO\NullIO;
use phpDocumentor\Reflection\Types\Null_;

class ScheduleRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getScheduleByGroup($group_id,$teachers=null,$disciplines=null){
        $columns = ['schedule'];
        
        $callScheduleRepository = app(CallScheduleRepository::class);
        $call = $callScheduleRepository->getCallScheduleForSchedule();
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

        $result = json_decode($this->startCondition()->select($columns)->where('group_id',$group_id)->toBase()->first()->schedule);

        foreach ((array)$result as $days => $row) {
            $current = $call->where('place.id',$result->{$days}->Place)->first();
                    
            foreach ((array)$current['schedule'] as $lessons =>$row2) {
                $result->{$days}->{$lessons}->time = $current['schedule']->{$lessons};
                if(count($result->{$days}->{$lessons}->LessonChisl)!=0){
                    for($i=0;$i<count($result->{$days}->{$lessons}->LessonChisl);$i++){
                        $foundDiscipline = $disciplines->where("id",$result->{$days}->{$lessons}->LessonChisl[$i])->first()->discipline_name;
                        $result->{$days}->{$lessons}->LessonChisl[$i] =  $foundDiscipline;
                    }

                    for($i=0;$i<count($result->{$days}->{$lessons}->TeacherChisl);$i++){
                        $foundTeacher = $teachers->where("id",$result->{$days}->{$lessons}->TeacherChisl[$i])->first()->fullFio;                   
                        $result->{$days}->{$lessons}->TeacherChisl[$i] =  $foundTeacher;
                    }  
                }
                if(count($result->{$days}->{$lessons}->LessonZnam)!=0){
                    for($i=0;$i<count($result->{$days}->{$lessons}->LessonZnam);$i++){
                        $foundDiscipline = $disciplines->where("id",$result->{$days}->{$lessons}->LessonZnam[$i])->first()->discipline_name;
                        $result->{$days}->{$lessons}->LessonZnam[$i] =  $foundDiscipline;
                    }

                    for($i=0;$i<count($result->{$days}->{$lessons}->TeacherZnam);$i++){
                        $foundTeacher = $teachers->where("id",$result->{$days}->{$lessons}->TeacherZnam[$i])->first()->fullFio;                   
                        $result->{$days}->{$lessons}->TeacherZnam[$i] =  $foundTeacher;
                    }  
                }
            } 
        }
        return $result;
    }

    public function getScheduleBildByGroup($group_id){
        $columns = ['schedule'];
        $result = json_decode($this->startCondition()->select($columns)->where('group_id',$group_id)->toBase()->first()->schedule);       
        return $result;
    }

    public function getScheduleIdByGroup($group_id)
    {
        $columns = ['id'];
        $result = $this->startCondition()->select($columns)->where('group_id', $group_id)->toBase()->first()->id;
        return $result;
    }
}