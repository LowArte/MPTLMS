<?php

namespace App\Modifications\Create;

use App\Models\AssociationUsersHomeWork as Model;
use App\Modifications\BaseModification;
use Debugbar;


class CreateAssociationUsersHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addAssociationUsersHomeWorkToDatabase($request)
    {
        $associationusershomework = new Model();
        $associationusershomework->fill($request);
        $result = $associationusershomework->save();
        if($result)
            return $associationusershomework->id;
        return  false;
    }
}