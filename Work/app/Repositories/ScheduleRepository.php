<?php

namespace App\Repositories;

use App\Models\Schedule as Model;

class ScheduleRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getScheduleByGroup($group_id){
        $columns = ['schedule'];
        $callScheduleRepository = app(CallScheduleRepository::class);
        $call = $callScheduleRepository->getCallScheduleForSchedule();
        $result = json_decode($this->startCondition()->select($columns)->where('group_id',$group_id)->toBase()->first()->schedule);
        foreach ((array)$result as $days => $row) {
            $current = $call->where('place.id',$result->{$days}->Place)->first();
            $result->{$days}->Place = $current['place'];        
            foreach ((array)$current['schedule'] as $lessons =>$row2) {
                $result->{$days}->{$lessons}->time = $current['schedule']->{$lessons};
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