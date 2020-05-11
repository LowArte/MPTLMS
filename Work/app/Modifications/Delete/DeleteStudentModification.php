<?php

namespace App\Modifications\Delete;
use App\Models\Student as Model;
use App\Modifications\BaseModification;

class DeleteStudentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteStudentFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}