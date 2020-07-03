<?php

namespace App\Modifications\Create;

use App\Models\Schedule as Model;
use App\Modifications\BaseModification;


class CreateScheduleModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addScheduleToDatabase($request)
    {
        $schedule = new Model();
        $schedule->fill($request);
        $result = $schedule->save();
        if($result)
            return $schedule->id;
        return  false;
    }
}