<?php

namespace App\Modifications\Delete;

use App\Models\Department as Model;
use App\Modifications\BaseModification;

class DeleteDepartmentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteDepartmentFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}