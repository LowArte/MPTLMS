<?php

namespace App\Repositories\ModelRepository;

use App\Models\Group as Model;

class GroupRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getGroupsForComboBoxByDepartament($dep_id)
    {
        $columns = ['id','group_name','group_number', 'group_year'];
        $result = $this->startCondition()->select($columns)->where('departament_id',$dep_id)->toBase()->get();
        return $result;
    }

    public function getGroups()
    {
        $columns = ['id','group_name','group_number', 'group_year', 'сurs', 'departament_id'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}