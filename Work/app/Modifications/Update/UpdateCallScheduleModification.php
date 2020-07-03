<?php

namespace App\Modifications\Update;

use App\Models\CallSchedule as Model;
use App\Modifications\BaseModification;

use Debugbar;

class UpdateCallScheduleModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateCallScheduleInDatabase($id, $data)
    {
        $callSchedule = $this->startCondition()->select('id')->where('id',$id)->toBase()->first();
        if($callSchedule == null){
            return false;
        }

        $callSchedule = $this->startCondition()->find($id);
        $callSchedule->call_schedule = json_encode($data);
        $callSchedule->save();
        return true;
    }
}