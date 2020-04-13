<?php

namespace App\Repositories\ModelRepository;

use App\Models\Places as Model;

class PlaceRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getPlaces(){
        $columns=['place_name','id','info'];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }

    public function getPlacesId(){
        $columns=['id'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}