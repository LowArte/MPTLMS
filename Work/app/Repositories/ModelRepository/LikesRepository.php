<?php

namespace App\Repositories\ModelRepository;

use App\Models\Likes as Model;

class LikesRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getLikesCount($new_id)
    {
        $result = $this->startCondition()->where("news_id", $new_id)->count();
        return $result;
    }

    public function getLikesForUser($new_id, $user_id)
    {
        $result = $this->startCondition()->where([["news_id", $new_id],["user_id", $user_id]])->first();
        return $result;
    }
}