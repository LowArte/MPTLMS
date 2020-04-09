<?php

namespace App\Modifications\Create;

use App\Models\Departament as Model;
use App\Modifications\BaseModification;
use Exception;
use Hash;

class CreateDepartamentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addDepartamentToDatabase($request)
    {
        $departament = new Model();
        $departament->fill($request);
        $result = $departament->save();
        if($result)
            return $departament->id;
        return  false;
    }
}