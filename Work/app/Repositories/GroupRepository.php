<?php

namespace App\Repositories;

use App\Models\Group as Model;

class GroupRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getGroupsForComboBoxByDepartament($dep_id)
    {
        $columns = ['group_name'];
        $result = $this->startCondition()->select($columns)->where('departaments_id',$dep_id)->toBase()->get();
        return $result;
    }
}