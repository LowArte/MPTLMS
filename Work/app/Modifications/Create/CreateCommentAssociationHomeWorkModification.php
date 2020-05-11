<?php

namespace App\Modifications\Create;

use App\Models\CommentAssociationHomeWork as Model;
use App\Modifications\BaseModification;


class CreateCommentAssociationHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addCommentAssociationHomeWorkToDatabase($request)
    {
        $commentassociationhomework = new Model();
        $commentassociationhomework->fill($request);
        $result = $commentassociationhomework->save();
        if($result)
            return $commentassociationhomework->id;
        return  false;
    }
}