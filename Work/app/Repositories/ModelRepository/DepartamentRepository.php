<?php

namespace App\Repositories\ModelRepository;

use App\Models\Departament as Model;

class DepartamentRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getDepartamentsForComboBox()
    {
        $columns = ['id', 'dep_name_full'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }

    public function getDepartamentsForCRUD()
    {
        $columns = ['id', 'dep_name', 'qualification', 'dep_name_full'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }


    public function getDepartamentsForDepartamentsInfo()
    {
        $columns = ['id', 'dep_name', 'qualification', 'dep_name_full', 'about', 'image', 'info', 'studysperiod'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}
