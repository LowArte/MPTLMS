<?php

namespace App\Repositories;

use App\Models\User as Model;

class UserRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getUsers()
    {   $columns = ['name','secName','thirdName','email','disabled','post_id'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}