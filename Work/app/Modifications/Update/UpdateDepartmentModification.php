<?php

namespace App\Modifications\Update;

use App\Models\Department as Model;
use App\Modifications\BaseModification;

use Debugbar;
use Exception;

class UpdateDepartmentModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function updateDepartmentInDatabase($data)
    {
        $department = $this->startCondition()->find($data['id']);
        $department->fill($data);
        $result = $department->save();
        if($result)
            return true;
        return  false;
    }
}