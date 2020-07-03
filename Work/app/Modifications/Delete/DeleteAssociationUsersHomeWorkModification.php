<?php

namespace App\Modifications\Delete;
use App\Models\AssociationUsersHomeWork as Model;
use App\Modifications\BaseModification;

class DeleteAssociationUsersHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteAssociationUsersHomeWorkFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }

    public function deleteAssociationUserHomeWorkById($home_work_id)
    {
        $result = $this->startCondition()->where('home_work_id', $home_work_id)->delete();
        return $result;
    }
}