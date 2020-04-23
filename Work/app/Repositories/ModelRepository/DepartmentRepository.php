<?php

namespace App\Repositories\ModelRepository;

use App\Models\Department as Model;

class DepartmentRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getDepartmentsForComboBox()
    {
        $columns = ['id', 'dep_name_full'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }

    public function getDepartmentsByID($id)
    {
        $columns = ['id', 'qualification', 'dep_name_full','image','info','studysperiod'];
        $result = $this->startCondition()->select($columns)->where('id',$id)->toBase()->first();
        return $result;
    }


    public function getDepartments()
    {
        $columns = ['id',  'qualification', 'dep_name_full',  'image', 'info', 'studysperiod'];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}