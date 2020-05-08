<?php

namespace App\Modifications\Delete;
use App\Models\Association as Model;
use App\Modifications\BaseModification;

class DeleteAssociationModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteAssociationFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}