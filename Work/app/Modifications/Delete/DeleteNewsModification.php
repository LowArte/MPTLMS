<?php

namespace App\Modifications\Delete;

use App\Models\News as Model;
use App\Modifications\BaseModification;

class DeleteNewsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteNewsFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}