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
}