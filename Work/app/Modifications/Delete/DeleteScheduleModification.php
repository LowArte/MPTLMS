<?php

namespace App\Modifications\Delete;
use App\Models\Schedule as Model;
use App\Modifications\BaseModification;

class DeleteScheduleModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteScheduleFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }

    public function deleteScheduleFromDatabaseByGroupId($group_id){
        $result = $this->startCondition()->where("group_id",$group_id)->first();
        if($result){
            return $result->delete();
        }
        return true;
    }
}