<?php

namespace App\Repositories\ModelRepository;

use App\Models\HomeWork as Model;

class HomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getHomeWork()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}