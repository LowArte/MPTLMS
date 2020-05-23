<?php

namespace App\Modifications\Create;

use App\Models\HomeWorkStudent as Model;
use App\Modifications\BaseModification;


class CreateHomeWorkStudentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addHomeWorkStudentToDatabase($request)
    {
        $homeworkstudent = new Model();
        $homeworkstudent->fill($request);
        $result = $homeworkstudent->save();
        if($result)
            return $homeworkstudent->id;
        return  false;
    }
}