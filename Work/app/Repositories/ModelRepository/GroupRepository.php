<?php

namespace App\Repositories\ModelRepository;

use App\Models\Group as Model;

use Debugbar;

class GroupRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getGroupsForComboBoxByDepartament($dep_id)
    {
        $columns = ['id','child_id','group_name'];
        $data = $this->startCondition()
                        ->select($columns)
                        ->with('child:id,group_name')
                        ->where([['departament_id',$dep_id]])
                        ->get();

        $result = collect();

        foreach($data as $dat){
            if($dat->haveParent()){
                $result->push([
                    'id'=>$dat->id,
                    'group_name'=>$dat->getFullName()
                ]);
            }
        }
        return $result;
    }

    public function getGroupsForComboBoxWithRecursive()
    {
        $columns = ['id','child_id','group_name','departament_id'];
        $data = $this->startCondition()
                        ->select($columns)
                        ->with('child:id,group_name')
                        ->get();

        $result = collect();

        foreach($data as $dat){
            if($dat->haveParent()){
                $result->push([
                    'id'=>$dat->id,
                    'group_name'=>$dat->getFullName(),
                    'departament_id'=>$dat->departament_id,
                ]);
            }

        }
        return $result;
    }

    public function getGroupsForComboBox()
    {
        $columns = ['id','group_name','departament_id'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->toBase()
                        ->get();
        return $result;
    }

    public function getGroups()
    {
        $columns = ['id','group_name','curs','child_id','departament_id'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->toBase()
                        ->get();
        return $result;
    }
}