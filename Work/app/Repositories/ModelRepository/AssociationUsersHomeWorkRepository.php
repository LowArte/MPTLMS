<?php

namespace App\Repositories\ModelRepository;

use App\Models\AssociationUsersHomeWork as Model;

class AssociationUsersHomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getAssociationUsersHomeWork()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}