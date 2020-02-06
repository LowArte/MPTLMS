<?php

namespace App\Repositories;

use App\Models\User as Model;

class UserRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getUsers()
    {   $columns = ['id','name','secName','thirdName','email','post_id','disabled'];
        $result = $this->startCondition()->select($columns)->with('post:id,name')->get();
        return $result;
    }

    public function getUserFIO($id)
    {   
        $columns = ['id','name','secName','thirdName'];
        $result = $this->startCondition()->select($columns)->where('id', $id)->first();
        return $result;
    }
}