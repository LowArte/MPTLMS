<?php

namespace App\Repositories;

use App\Models\Places as Model;

class PlaceRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getPlaceForCalls(){
        $columns=['place_name','id'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }

}