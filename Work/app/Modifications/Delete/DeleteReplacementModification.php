<?php

namespace App\Modifications\Delete;

use App\Models\ScheduleSwap as Model;
use App\Modifications\BaseModification;

class DeleteReplacementModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteReplacementFromDatabase($id)
    {
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}