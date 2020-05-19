<?php

namespace App\Repositories\ModelRepository;

use App\Models\HomeWork as Model;

class HomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getHomeWorkById($homework_id)
    {
        $columns = ['id', 'info', 'type', 'created_at as date'];
        $result = $this->startCondition()
                        ->where('id', $homework_id)
                        ->select($columns)
                        ->first();
        $result = json_decode($result);
        $result->info = json_decode($result->info);
        return $result;
    }

    public function getHomeWorkTeacher($user_id)
    {
        $columns = ['id', 'info', 'type', 'created_at as date'];
        $result = $this->startCondition()
                        ->where('user_id', $user_id)
                        ->select($columns)
                        ->get();

        //Получение ассоциаций домашних заданий
        $associationHomeWorkRepository = app(AssociationHomeWorkRepository::class);
        $associationHomeWork = $associationHomeWorkRepository->getAssociationHomeWork();

        foreach($result as $value)
        {
            $value['info'] = json_decode($value['info']);
            $value['title'] = $value['info']->title;
            $value['text'] = $value['info']->text;
            $value['dates_homework'] = $value['info']->date;
            if(isset($value['info']))
                unset($value['info']);

            $groups = [];
            foreach($associationHomeWork->where("homework_id",$value->id) as $group)
                array_push($groups, $group['group']['group_name']);
            
            $value['groups'] = $groups;
        }
        return $result;
    }
}