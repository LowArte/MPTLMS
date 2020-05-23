<?php

namespace App\Modifications\Create;

use App\Models\HomeWorkStudentDocument as Model;
use App\Modifications\BaseModification;


class CreateHomeWorkStudentDocumentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addHomeWorkStudentDocumentToDatabase($request)
    {
        $homeworkstudentdocument = new Model();
        $homeworkstudentdocument->fill($request);
        $result = $homeworkstudentdocument->save();
        if($result)
            return $homeworkstudentdocument->id;
        return  false;
    }
}