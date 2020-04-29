<?php

namespace App\Modifications\Create;

use App\Models\Department as Model;
use App\Modifications\BaseModification;
use Exception;

class CreateDepartmentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addDepartmentToDatabase($request)
    {
        $department = new Model();
        $department->fill($request);
        $result = $department->save();
        if($result)
            return $department->id;
        return  false;
    }
}