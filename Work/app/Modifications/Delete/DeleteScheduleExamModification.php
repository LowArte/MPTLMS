<?php

namespace App\Modifications\Delete;

use App\Models\ScheduleExams as Model;
use App\Modifications\BaseModification;
use Carbon\Carbon;

class DeleteScheduleExamModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteScheduleExamFromDatabase($id)
    {
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }

    public function deleteScheduleExamOldFromDatabase()
    {
        $result = $this->startCondition()->where('date','<=', Carbon::yesterday())->delete();
        return $result;
    }
}