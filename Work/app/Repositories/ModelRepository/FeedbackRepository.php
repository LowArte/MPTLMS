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
        $columns = ['feedback.id', 'user_id', 'type', 'text', 'answered', 'feedback.created_at'];
        $result = $this->startCondition()
        ->join('users', 'user_id', '=', 'users.id')
        ->select($columns)
        ->selectRaw("CONCAT(users.name,users.secName,users.thirdName) as fullFio, users.email")
        ->orderBy('id', 'desc')
        ->toBase()
        ->get();   
        return $result;
    }
}