<?php

namespace App\Repositories\ModelRepository;

use App\Models\CommentAssociationHomeWork as Model;

class CommentAssociationHomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getCommentAssociationHomeWork()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}