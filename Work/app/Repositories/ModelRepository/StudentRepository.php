<?php

namespace App\Repositories\ModelRepository;

use App\Models\Student as Model;
use Debugbar;

class StudentRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getStudentsByGroupId($group_id)
    {
        $columns = ['id','user_id'];
        $result = $this->startCondition()
                ->where("group_id", $group_id)
                ->with("user:id,name,secName,thirdName")
                ->get();
        return $result;
    }

    public function getStudents()
    {
        $columns = ['students.id','user_id','group_id'];
        $result = $this->startCondition()
                ->join('users', 'user_id', '=', 'users.id')
                ->select($columns)
                ->selectRaw("CONCAT(users.secName, ' ', users.name, ' ',  users.thirdName) as fullFio")
                ->toBase()
                ->get();
        return $result;
    }
}