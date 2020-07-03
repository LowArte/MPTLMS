<?php

namespace App\Modifications\Create;

use App\Models\CallSchedule as Model;
use App\Modifications\BaseModification;


class CreateCallScheduleModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addCallScheduleToDatabase($request)
    {
        $callschedule = new Model();
        $callschedule->fill($request);
        $result = $callschedule->save();
        if($result)
            return $callschedule->id;
        return  false;
    }
}