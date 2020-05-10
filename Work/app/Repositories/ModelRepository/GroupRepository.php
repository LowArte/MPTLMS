<?php

namespace App\Repositories\ModelRepository;

use App\Models\Group as Model;
use App\Models\Association as AssociationModel;

use Debugbar;

class GroupRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    //Получение групп и ассоциаций для них
    public function getGroupsAndAssociation()
    {
        $columns = ['groups.id as group_id', 'group_name', 'department_id', 'dep_name_full', 'curs'];
        $result = $this->startCondition()
                        ->join('departments', 'department_id', '=', 'departments.id')
                        ->select($columns)
                        ->with('child:id,group_name')
                        ->get();
        /*$columns = ['associations.id', 'teacher_id', 'group_id', 'discip_id', 'journals.isClose', 'journals.id as journal_id'];

        $teachersRepository = app(TeacherRepository::class);
        $teachers = $teachersRepository->getTeachersWithFio();
        $disciplineRepository = app(DisciplineRepository::class);
        $disciplines = $disciplineRepository->getDisciplines();

        foreach($result as $value)
        {
            $value->association = AssociationModel::where('group_id', $value->group_id)
                                                    ->select($columns)
                                                    ->leftJoin('journals', 'associations.id', '=', 'journals.association_id')
                                                    ->get();
            foreach($value->association as $assoctiation)
            {
                $assoctiation->teacher = $teachers->where("id",$assoctiation->teacher_id)->first()->fullFio;
                $assoctiation->discip = $disciplines->where("id",$assoctiation->discip_id)->first()->discipline_name;
            }
        }*/

        return $result;
    }

    public function getGroupsForComboBoxByDepartment($dep_id)
    {
        $columns = ['id','child_id','group_name','curs'];
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
                    'curs'=>$dat->curs
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
        $columns = ['id','group_name','department_id','curs'];
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
}