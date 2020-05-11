<?php

namespace App\Modifications\Delete;
use App\Models\CommentHomeWork as Model;
use App\Modifications\BaseModification;

class DeleteCommentHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteCommentHomeWorkFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}