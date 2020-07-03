<?php

namespace App\Modifications\Create;

use App\Models\Association as Model;
use App\Modifications\BaseModification;
use Debugbar;


class CreateAssociationModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addAssociationToDatabase($request)
    {
        $association = new Model();
        $association->fill($request);
        $result = $association->save();
        if($result)
            return $association->id;
        return  false;
    }
}