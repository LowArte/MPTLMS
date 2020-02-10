<?php

namespace App\Repositories\ModelRepository;

use App\Models\UsersPost as Model;

class UsersPostRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getPosts()
    {   $columns = ['name','id'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}