<?php

namespace App\Modifications\Update;

use App\Models\ScheduleExams as Model;
use App\Modifications\BaseModification;

use Debugbar;

class UpdateScheduleExamModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateScheduleExamInDatabase($data)
    {
        $schedule = $this->startCondition()->select('id')->where('id',$data['id'])->toBase()->first();
        if($schedule == null){
            return false;
        }

        $schedule = $this->startCondition()->find($data['id']);
        $data['info'] = json_encode($data['info']);
        $schedule->info = $data['info'];
        $schedule->place_id = $data['place_id'];
        $schedule->group_id = $data['group_id'];
        $schedule->date = $data['date'];
        $schedule->save();
        return true;
    }
}