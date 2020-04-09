<?php

namespace App\Modifications\Update;

use App\Models\Departament as Model;
use App\Modifications\BaseModification;

use Debugbar;
use Exception;

class UpdateDepartamentModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function updateDepartamentInDatabase($data)
    {
        $departament = $this->startCondition()->find($data['id']);
        $departament->fill($data);
        $result = $departament->save();
        if($result)
            return true;
        return  false;
    }
}