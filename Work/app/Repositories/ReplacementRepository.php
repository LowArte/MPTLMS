<?php

namespace App\Repositories;

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
    public function getReplacements($where)
    {
        $columns = ['schedule_swaps.id', 'schedule_swaps.swap_date', 'schedule_swaps.swap', 'schedule_swaps.created_at', 'groups.group_name'];
        $result = $this->startCondition()
        ->where($where)
        ->join('schedules', 'schedule_swaps.schedule_id', '=', 'schedules.id')
        ->join('groups', 'schedules.group_id', '=', 'groups.id')
        ->orderBy('groups.id', 'asc')
        ->select($columns)
        ->orderBy('swap_date', 'desc')
        ->toBase()->get();
        return $result;
    }
}