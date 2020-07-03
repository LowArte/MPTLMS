<?php

namespace App\Modifications\Update;

use App\Models\CommentHomeWork as Model;
use App\Modifications\BaseModification;


class UpdateCommentHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateCommentHomeWorkInDatabase($data)
    {
        $commenthomework = $this->startCondition()->find($data['id']);
        $commenthomework->fill($data);
        $result = $commenthomework->save();
        if($result)
            return true;
        return  false;
    }
}