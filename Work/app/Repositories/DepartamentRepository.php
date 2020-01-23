<?php

namespace App\Repositories;

use App\Models\Departament as Model;

class DepartamentRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getDepartamentsForComboBox()
    {
        $columns = ['id','dep_name_full'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }

    public function getDepartaments()
    {
        $columns = ['id', 'dep_name', 'specialization', 'dep_name_full'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}