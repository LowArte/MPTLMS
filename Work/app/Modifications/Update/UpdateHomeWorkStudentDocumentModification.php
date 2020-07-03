<?php

namespace App\Modifications\Update;

use App\Models\HomeWorkStudentDocument as Model;
use App\Modifications\BaseModification;


class UpdateHomeWorkStudentDocumentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateHomeWorkStudentDocumentInDatabase($data)
    {
        $homeworkstudentdocument = $this->startCondition()->find($data['id']);
        $homeworkstudentdocument->fill($data);
        $result = $homeworkstudentdocument->save();
        if($result)
            return true;
        return  false;
    }
}