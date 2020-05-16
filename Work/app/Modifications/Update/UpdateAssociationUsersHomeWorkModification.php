<?php

namespace App\Modifications\Update;

use App\Models\AssociationUsersHomeWork as Model;
use App\Modifications\BaseModification;


class UpdateAssociationUsersHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateAssociationUsersHomeWorkInDatabase($data)
    {
        $associationusershomework = $this->startCondition()->find($data['id']);
        $associationusershomework->fill($data);
        $result = $associationusershomework->save();
        if($result)
            return true;
        return  false;
    }
}