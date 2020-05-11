<?php

namespace App\Modifications\Update;

use App\Models\CommentAssociationHomeWork as Model;
use App\Modifications\BaseModification;


class UpdateCommentAssociationHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateCommentAssociationHomeWorkInDatabase($data)
    {
        $commentassociationhomework = $this->startCondition()->find($data['id']);
        $commentassociationhomework->fill($data);
        $result = $commentassociationhomework->save();
        if($result)
            return true;
        return  false;
    }
}