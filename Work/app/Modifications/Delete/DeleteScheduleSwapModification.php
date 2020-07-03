<?php

namespace App\Modifications\Delete;
use App\Models\ScheduleSwap as Model;
use App\Modifications\BaseModification;

class DeleteScheduleSwapModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteScheduleSwapFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}