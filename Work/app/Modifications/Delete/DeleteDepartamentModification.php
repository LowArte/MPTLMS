<?php

namespace App\Modifications\Delete;

use App\Models\Departament as Model;
use App\Modifications\BaseModification;

class DeleteDepartamentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteDepartamentFromDatabase($id){
        $departament = $this->startCondition()->find($id);
        $result = $departament->delete();
        return $result;
    }

    public function deleteAllDepartamentFromDatabase(){
        $result = Model::query()->truncate();
        print_r($result);
        return true;
    }
}