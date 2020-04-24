<?php

namespace App\Modifications\Delete;
use App\Models\Group as Model;
use App\Modifications\BaseModification;

class DeleteGroupModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteGroupFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}