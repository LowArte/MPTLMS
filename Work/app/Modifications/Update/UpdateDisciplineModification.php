<?php

namespace App\Modifications\Update;

use App\Models\Discipline as Model;
use App\Modifications\BaseModification;


class UpdateDisciplineModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateDisciplineInDatabase($data)
    {
        $discipline = $this->startCondition()->find($data['id']);
        $discipline->fill($data);
        $result = $discipline->save();
        if($result)
            return true;
        return  false;
    }
}