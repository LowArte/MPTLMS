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
        $schedule->schedule = json_encode($data);
        $schedule->save();
        return true;
    }

    public function updateScheduleClassroomInDatabase($data)
    {
        $scheduleData = $data['schedule'];
        $day = $data['day'];

        foreach($scheduleData as $value)
        {
            $result = Model::where('id', $value['schedule_id'])->first();
            $result->schedule = json_decode($result->schedule);
            $result->schedule->$day = $value['bild'];
            $result->schedule = json_encode($result->schedule);
            $result->save();
        }
        return true;
    }
}