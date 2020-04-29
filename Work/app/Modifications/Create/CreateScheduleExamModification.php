<?php

namespace App\Modifications\Create;

use App\Models\ScheduleExams as Model;
use App\Modifications\BaseModification;


class CreateScheduleExamModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addScheduleExamToDatabase($request)
    {
        $schedule = new Model();
        $request['info'] = json_encode($request['info']);
        $schedule->fill($request);
        $schedule = $schedule->save();
        if($schedule)
            return true;
        return  false;
    }
}