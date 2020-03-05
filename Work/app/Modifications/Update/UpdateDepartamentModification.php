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

    public function updateDepartamentInDatabase($id,$data)
    {
        $departament = $this->startCondition()->find($id);
        try{
            $departament->fill($data);
            $departament->save();
        }
        catch(Exception $e){
            return false;
        }
        return true;
    }
}