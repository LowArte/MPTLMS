<?php

namespace App\Modifications\Create;

use App\Models\Student as Model;
use App\Modifications\BaseModification;


class CreateStudentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addStudentToDatabase($request)
    {
        $student = new Model();
        $student->fill($request);
        $result = $student->save();
        if($result)
            return $student->id;
        return  false;
    }
}