<?php

namespace App\Modifications\Create;

use App\Models\HomeWorkDocument as Model;
use App\Modifications\BaseModification;


class CreateHomeWorkDocumentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addHomeWorkDocumentToDatabase($request)
    {
        $homeworkdocument = new Model();
        $homeworkdocument->fill($request);
        $result = $homeworkdocument->save();
        if($result)
            return $homeworkdocument->id;
        return  false;
    }
}