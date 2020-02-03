<?php

namespace App\Modifications\Update;

use App\Models\Schedule as Model;
use App\Modifications\BaseModification;

use Debugbar;

class UpdateScheduleModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateScheduleInDatabase($id, $data)
    {
        $schedule = $this->startCondition()->select('id')->where('id',$id)->toBase()->first();
        if($schedule == null){
            return false;
        }

        $schedule = $this->startCondition()->find($id);
        $schedule->schedule = $data;
        $schedule->save();
        return true;
    }
}