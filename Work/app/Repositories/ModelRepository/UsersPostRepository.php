<?php

namespace App\Repositories\ModelRepository;

use App\Models\UsersPost as Model;

class UsersPostRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getPostsFull()
    {   $columns = ['name','id', 'privilegies'];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }

    public function getPosts()
    {   $columns = ['name','id'];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }

    public function getPostsForManagement()
    {   $columns = ['id', 'name', 'slug'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}