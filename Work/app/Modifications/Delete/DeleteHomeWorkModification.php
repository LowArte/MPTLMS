<?php

namespace App\Modifications\Delete;
use App\Models\HomeWork as Model;
use App\Modifications\BaseModification;

class DeleteHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteHomeWorkFromDatabase($home_work_id){
        $result = $this->startCondition()->find($home_work_id)->delete();
        return $result;
    }
}