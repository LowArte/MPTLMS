<?php

namespace App\Modifications\Update;

use App\Models\HomeWorkStudent as Model;
use App\Modifications\BaseModification;


class UpdateHomeWorkStudentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateHomeWorkStudentInDatabase($data)
    {
        $homeworkstudent = $this->startCondition()->find($data['id']);
        $homeworkstudent->fill($data);
        $result = $homeworkstudent->save();
        if($result)
            return true;
        return  false;
    }
}