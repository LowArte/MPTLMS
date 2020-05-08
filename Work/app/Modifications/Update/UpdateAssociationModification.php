<?php

namespace App\Modifications\Update;

use App\Models\Association as Model;
use App\Modifications\BaseModification;


class UpdateAssociationModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateAssociationInDatabase($data)
    {
        $association = $this->startCondition()->find($data['id']);
        $association->fill($data);
        $result = $association->save();
        if($result)
            return true;
        return  false;
    }
}