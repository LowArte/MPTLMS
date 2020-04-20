<?php

namespace App\Repositories\ModelRepository;

use App\Models\Likes as Model;

class LikesRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getLikes()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}