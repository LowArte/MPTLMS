<?php

namespace App\Modifications\Delete;
use App\Models\Discipline as Model;
use App\Modifications\BaseModification;

class DeleteDisciplineModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteDisciplineFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}