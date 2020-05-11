<?php

namespace App\Repositories\ModelRepository;

use App\Models\Teacher as Model;

class TeacherRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getTeachersWithFio()
    {
        $result = $this->startCondition()->join('users', 'teachers.user_id', '=', 'users.id')
                        ->selectRaw("`teachers`.id as teacher_id,`users`.id as id, CONCAT(users.secName, ' ', users.name, ' ',  users.thirdName) as fullFio")
                        ->toBase()
                        ->get();      
        return $result;
    }
}