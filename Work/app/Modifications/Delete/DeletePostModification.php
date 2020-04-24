<?php

namespace App\Modifications;

use App\Models\UsersPost as Model;
use App\Modifications\BaseModification;


class DeletePostModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deletePostFromDatabase($id)
    {
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}