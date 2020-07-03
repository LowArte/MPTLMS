<?php

namespace App\Modifications\Update;

use App\Models\HomeWork as Model;
use App\Modifications\BaseModification;


class UpdateHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateHomeWorkInDatabase($data)
    {
        $homework = $this->startCondition()->find($data['id']);
        $homework->fill($data);
        $result = $homework->save();
        if($result)
            return true;
        return  false;
    }
}