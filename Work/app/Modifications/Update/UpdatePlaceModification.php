<?php

namespace App\Modifications\Update;

use App\Models\Places as Model;
use App\Modifications\BaseModification;

class UpdatePlaceModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function updatePlaceInDatabase($data)
    {
        $place = $this->startCondition()->find($data['id']);
        $place->fill($data);
        $result = $place->save();
        if($result)
            return true;
        return  false;
    }
}