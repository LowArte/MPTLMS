<?php

namespace App\Repositories\ModelRepository;

use App\Models\Association as Model;

class AssociationRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getAssociation()
    {
        $columns = ['id', 'group_id', 'teacher_id', 'discip_id'];
        $result = $this->startCondition()
        ->select($columns)->get();
        return $result;
    }

    public function getAssociationTeacher($teacher_id)
    {
        $columns = ['id', 'group_id', 'teacher_id', 'discip_id'];
        $result = $this->startCondition()->where('teacher_id', $teacher_id)->select($columns)->get();
        return $result;
    }

    public function getAssociationGroup($group_id)
    {
        $columns = ['id', 'group_id', 'teacher_id', 'discip_id'];
        $result = $this->startCondition()->where('group_id', $group_id)->select($columns)->get();
        return $result;
    }

    public function checkAssociationUnique($data)
    {
        $columns = ['id', 'group_id', 'teacher_id', 'discip_id'];
        $result = $this->startCondition()->where([['group_id',$data['group_id']],['teacher_id',$data['teacher_id']],['discip_id',$data['discip_id']]])->select($columns)->first();
        return $result;
    }
}