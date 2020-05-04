<?php

namespace App\Modifications\Update;

use App\Models\ScheduleSwap as Model;
use App\Modifications\BaseModification;


class UpdateScheduleSwapModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateScheduleSwapInDatabase($data)
    {
        $scheduleswap = $this->startCondition()->find($data['id']);
        $scheduleswap->fill($data);
        $result = $scheduleswap->save();
        if($result)
            return true;
        return  false;
    }
}