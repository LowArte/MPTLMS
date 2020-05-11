<?php

namespace App\Modifications\Update;

use App\Models\Student as Model;
use App\Modifications\BaseModification;


class UpdateStudentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateStudentInDatabase($data)
    {
        $student = $this->startCondition()->find($data['id']);
        $student->fill($data);
        $result = $student->save();
        if($result)
            return true;
        return  false;
    }
}