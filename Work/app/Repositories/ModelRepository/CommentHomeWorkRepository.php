<?php

namespace App\Repositories\ModelRepository;

use App\Models\CommentHomeWork as Model;

class CommentHomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getCommentHomeWork()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}