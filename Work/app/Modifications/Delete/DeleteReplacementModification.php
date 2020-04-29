<?php

namespace App\Modifications\Delete;

use App\Models\ScheduleSwap as Model;
use App\Modifications\BaseModification;
use Carbon\Carbon;

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

    public function deleteReplacementOldFromDatabase()
    {
        $result = $this->startCondition()->where('swap_date','<=', Carbon::yesterday())->delete();
        return $result;
    }
}