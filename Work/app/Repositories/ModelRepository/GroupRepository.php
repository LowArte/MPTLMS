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
        $result = $this->startCondition()
                        ->selectRaw("id, CONCAT(group_name, '-', group_number, '-', group_year) as group_name")
                        ->where('departament_id',$dep_id)
                        ->toBase()
                        ->get();
        return $result;
    }

    public function getGroups()
    {
        $result = $this->startCondition()
                        ->selectRaw("id, group_name, group_number, group_year, сurs, departament_id, CONCAT(group_name, '-', group_number, '-', group_year) as full_group_name")
                        ->toBase()
                        ->get();
        return $result;
    }
}