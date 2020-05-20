<?php

namespace App\Repositories\ModelRepository;

use App\Models\CommentHomeWork as Model;

class CommentHomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getCommentHomeWork($home_work_id)
    {
        $columns = ["comment", "user_id", 'home_work_id'];
        $result = $this->startCondition()
                        ->where('home_work_id', $home_work_id)
                        ->select($columns)
                        ->get();
        $userRepository = app(UserRepository::class);
        $users = $userRepository->getFullRuFIO();
        foreach($result as $value)
            $value['full_fio'] = $users->where("id",$value->user_id)->first()->fullFio;
        return $result;
    }
}