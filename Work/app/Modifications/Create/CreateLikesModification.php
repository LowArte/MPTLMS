<?php

namespace App\Modifications\Create;

use App\Models\Likes as Model;
use App\Modifications\BaseModification;

class CreateLikesModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function addLikeToDatabase($new_id, $user_id)
    {
        $like = new Model();
        $like->news_id = $new_id;
        $like->user_id = $user_id;
        $result = $like->save();
        if ($result)
            return true;
        return  false;
    }
}
