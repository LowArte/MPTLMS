<?php

namespace App\Repositories\ModelRepository;

use App\Models\Discipline as Model;

class DisciplineRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getDisciplines()
    {
        $columns=['discipline_name','id'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}