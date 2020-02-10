<?php

namespace App\Repositories\ModelRepository;

use App\Models\Feedback as Model;

class FeedbackRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getFeedback()
    {
        $columns = ['id', 'user_id', 'type', 'text', 'answered'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}