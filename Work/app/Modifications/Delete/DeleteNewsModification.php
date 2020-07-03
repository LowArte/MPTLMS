<?php

namespace App\Modifications\Delete;

use App\Models\News as Model;
use App\Modifications\BaseModification;
use App\Models\Likes;

class DeleteNewsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteNewsFromDatabase($id)
    {
        Likes::where('news_id', $id)->delete();
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}