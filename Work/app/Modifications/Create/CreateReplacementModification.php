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

    public function addReplacementToDatabase($data, $id)
    {
        $replacement = new Model();
        $replacement->swap_date = $data['date'];
        $replacement->swap = json_encode($data['replacement']);
        $replacement->schedule_id = $id;
        $replacement->save();
        
        return true;
    }
}