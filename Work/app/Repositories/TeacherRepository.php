<?php

namespace App\Repositories;

use App\Models\Teacher as Model;

class TeacherRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getTeachers()
    {
        $columns=['id', 'user_id'];
        $result = $this->startCondition()->select($columns)->get();        
        return $result;
    }
}