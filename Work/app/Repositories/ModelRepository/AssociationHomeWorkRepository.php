<?php

namespace App\Repositories\ModelRepository;

use App\Models\AssociationHomeWork as Model;

class AssociationHomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getAssociationHomeWork()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}