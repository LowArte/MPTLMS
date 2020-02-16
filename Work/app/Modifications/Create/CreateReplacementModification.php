<?php

namespace App\Modifications\Create;

use App\Models\ScheduleSwap as Model;
use App\Modifications\BaseModification;
use Hash;

class CreateReplacementModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addReplacementToDatabase($newreplacement, $date,  $id)
    {
        $replacement = new Model();
        $replacement->swap_date = $date;
        $replacement->swap = json_encode($newreplacement);
        $replacement->schedule_id = $id;
        $replacement->save();
        
        return true;
    }
}