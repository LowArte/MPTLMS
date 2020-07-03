<?php

namespace App\Modifications\Create;

use App\Models\Discipline as Model;
use App\Modifications\BaseModification;


class CreateDisciplineModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addDisciplineToDatabase($request)
    {
        $discipline = new Model();
        $discipline->fill($request);
        $result = $discipline->save();
        if($result)
            return $discipline->id;
        return  false;
    }
}