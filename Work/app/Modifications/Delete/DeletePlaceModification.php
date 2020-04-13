<?php

namespace App\Modifications\Delete;

use App\Models\Places as Model;
use App\Modifications\BaseModification;

class DeletePlaceModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deletePlaceFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }

}