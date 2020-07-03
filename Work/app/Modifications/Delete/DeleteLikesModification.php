<?php

namespace App\Modifications\Delete;

use App\Models\Likes as Model;
use App\Modifications\BaseModification;

class DeleteLikesModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteLikesFromDatabase($user_id, $new_id)
    {
        $result = $this->startCondition()->where([['user_id', $user_id],['news_id', $new_id]])->delete();
        return $result;
    }
}