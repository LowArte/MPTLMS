<?php

namespace App\Repositories\ModelRepository;

use App\Models\AssociationHomeWork as Model;

class AssociationHomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getAssociationHomeWorkByHomeWorkId($home_work)
    {
        $columns = ['id', 'homework_id', 'group_id', 'home_work_access'];
        $result = $this->startCondition()
                        ->where('homework_id', $home_work)
                        ->with("group:id,group_name")
                        ->select($columns)
                        ->get();

        
        return $result;
    }

    public function getAssociationHomeWork()
    {
        $columns = ['id', 'homework_id', 'group_id', 'home_work_access'];
        $result = $this->startCondition()
                        ->with("group:id,group_name")
                        ->select($columns)
                        ->get();

        
        return $result;
    }
}