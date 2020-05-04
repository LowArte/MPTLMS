<?php

namespace App\Repositories\ModelRepository;

use App\Models\ScheduleSwap as Model;

class ScheduleSwapRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getScheduleSwap()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}