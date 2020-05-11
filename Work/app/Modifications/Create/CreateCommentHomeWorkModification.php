<?php

namespace App\Modifications\Create;

use App\Models\CommentHomeWork as Model;
use App\Modifications\BaseModification;


class CreateCommentHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addCommentHomeWorkToDatabase($request)
    {
        $commenthomework = new Model();
        $commenthomework->fill($request);
        $result = $commenthomework->save();
        if($result)
            return $commenthomework->id;
        return  false;
    }
}