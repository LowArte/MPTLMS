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
        $columns = ['id','group_name'];
        $result = $this->startCondition()->select($columns)->where('departaments_id',$dep_id)->toBase()->get();
        return $result;
    }

    public function getGroups()
    {
        $columns = ['id','group_name','study_period', 'type_of_study', 'сurs', 'departaments_id'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}