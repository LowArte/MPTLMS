<?php

namespace App\Repositories\ModelRepository;

use App\Models\User as Model;

class TeacherRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getTeachersWithFio()
    {
        $result = $this->startCondition()
                        ->where("post_id", 3)
                        ->selectRaw("`users`.id, CONCAT(users.secName, ' ', users.name, ' ',  users.thirdName) as fullFio")
                        ->toBase()
                        ->get();      
        return $result;
    }
}