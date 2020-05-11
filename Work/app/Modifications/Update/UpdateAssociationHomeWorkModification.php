<?php

namespace App\Modifications\Update;

use App\Models\AssociationHomeWork as Model;
use App\Modifications\BaseModification;


class UpdateAssociationHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateAssociationHomeWorkInDatabase($data)
    {
        $associationhomework = $this->startCondition()->find($data['id']);
        $associationhomework->fill($data);
        $result = $associationhomework->save();
        if($result)
            return true;
        return  false;
    }
}