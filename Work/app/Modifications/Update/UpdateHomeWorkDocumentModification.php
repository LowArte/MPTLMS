<?php

namespace App\Modifications\Update;

use App\Models\HomeWorkDocument as Model;
use App\Modifications\BaseModification;


class UpdateHomeWorkDocumentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateHomeWorkDocumentInDatabase($data)
    {
        $homeworkdocument = $this->startCondition()->find($data['id']);
        $homeworkdocument->fill($data);
        $result = $homeworkdocument->save();
        if($result)
            return true;
        return  false;
    }
}