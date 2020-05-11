<?php

namespace App\Modifications\Create;

use App\Models\AssociationHomeWork as Model;
use App\Modifications\BaseModification;


class CreateAssociationHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addAssociationHomeWorkToDatabase($request)
    {
        $associationhomework = new Model();
        $associationhomework->fill($request);
        $result = $associationhomework->save();
        if($result)
            return $associationhomework->id;
        return  false;
    }
}