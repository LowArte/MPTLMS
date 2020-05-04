<?php

namespace App\Repositories\ModelRepository;

use App\Models\Group as Model;

use Debugbar;

class GroupRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getGroupsForComboBoxByDepartment($dep_id)
    {
        $columns = ['id','child_id','group_name'];
        $data = $this->startCondition()
                        ->select($columns)
                        ->with('child:id,group_name')
                        ->where([['department_id',$dep_id]])
                        ->get();

        $result = collect();

        foreach($data as $dat){
            if($dat->haveParent()){
                $result->push([
                    'id'=>$dat->id,
                    'group_name'=>$dat->getFullName(),
                    'child_id'=>$dat->child_id,
                ]);
            }
        }
        return $result;
    }

    public function getGroupsForComboBoxWithRecursive()
    {
        $columns = ['id','child_id','group_name','department_id'];
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
                    'department_id'=>$dat->department_id,
                ]);
            }

        }
        return $result;
    }

    public function getGroupsForComboBox()
    {
        $columns = ['id','group_name','department_id'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->toBase()
                        ->get();
        return $result;
    }

    public function getGroups()
    {
        $columns = ['id','group_name','curs','child_id','department_id'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->toBase()
                        ->get();
        return $result;
    }

    public function getGroupsWithoutChild()
    {
        $columns = ['id','group_name','department_id'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->where("child_id",null)
                        ->get();
        return $result;
    }


}