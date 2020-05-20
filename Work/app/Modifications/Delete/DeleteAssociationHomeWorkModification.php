<?php

namespace App\Modifications\Delete;
use App\Models\AssociationHomeWork as Model;
use App\Modifications\BaseModification;

class DeleteAssociationHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteAssociationHomeWorkFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }

    public function deleteAssociationHomeWorkById($home_work_id)
    {
        $result = $this->startCondition()->where('home_work_id', $home_work_id)->delete();
        return $result;
    }
}