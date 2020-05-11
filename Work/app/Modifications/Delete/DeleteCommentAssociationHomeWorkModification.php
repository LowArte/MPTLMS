<?php

namespace App\Modifications\Delete;
use App\Models\CommentAssociationHomeWork as Model;
use App\Modifications\BaseModification;

class DeleteCommentAssociationHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteCommentAssociationHomeWorkFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}