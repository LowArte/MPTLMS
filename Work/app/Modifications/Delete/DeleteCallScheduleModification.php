<?php

namespace App\Modifications\Delete;
use App\Models\CallSchedule as Model;
use App\Modifications\BaseModification;

class DeleteCallScheduleModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteCallScheduleFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }

    
    public function deleteCallScheduleFromDatabaseByPlaceId($place_id){
        $result = $this->startCondition()->where('place_id',$place_id)->first()->delete();
        return $result;
    }
}