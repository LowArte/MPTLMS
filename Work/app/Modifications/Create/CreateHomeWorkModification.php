<?php

namespace App\Modifications\Create;

use App\Models\HomeWork as Model;
use App\Modifications\BaseModification;


class CreateHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addHomeWorkToDatabase($request)
    {
        $homework = new Model();
        $homework->fill($request);
        $result = $homework->save();
        if($result)
            return $homework->id;
        return  false;
    }
}