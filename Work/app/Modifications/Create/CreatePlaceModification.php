<?php

namespace App\Modifications\Create;

use App\Models\Places as Model;
use App\Modifications\BaseModification;
use Hash;

class CreatePlaceModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function addPlaceToDatabase($data)
    {
        $place = new Model();
        $place->fill($data);
        $result = $place->save();
        if ($result)
            return $place->id;
        return  false;
    }
}
