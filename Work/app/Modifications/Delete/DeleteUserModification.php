<?php

namespace App\Modifications\Delete;

use App\Models\User as Model;
use App\Modifications\BaseModification;

class DeleteUserModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteUserFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}