<?php

namespace App\Repositories\ModelRepository;

use App\Models\DepartmentBuffer as Model;

class DepartmentBufferRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getDepartmentBuffer()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}