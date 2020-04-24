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
        $columns = ['id', 'user_id', 'type', 'text', 'answered', 'created_at'];
        $result = $this->startCondition()->select($columns)->with('user:id,email')->orderBy('id', 'desc')->get();
        return $result;
    }
}