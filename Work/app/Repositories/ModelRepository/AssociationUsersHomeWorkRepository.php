<?php

namespace App\Repositories\ModelRepository;

use App\Models\AssociationUsersHomeWork as Model;

class AssociationUsersHomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getAssociationUsersHomeWorkByTeacherId($user_id)
    {
        $columns = ['home_work.user_id', 'home_work.id', 'info', 'type', 'home_work.created_at as date'];
        $result = $this->startCondition()
                        ->join('home_work', 'home_work_id', '=', 'home_work.id')
                        ->where('association_users_home_work.user_id', $user_id)
                        ->select($columns)
                        ->get();

        //Получение ассоциаций домашних заданий
        $associationHomeWorkRepository = app(AssociationHomeWorkRepository::class);
        $associationHomeWork = $associationHomeWorkRepository->getAssociationHomeWork();

        $teacherRepository = app(UserRepository::class);
        $teachers = $teacherRepository->getTeachersFIO();
        foreach($result as $key => $value)
        {
            $result[$key]['teacher_admin'] = $teachers->where("id",$value['user_id'])->first()->full_name;

            $value['info'] = json_decode($value['info']);
            $value['title'] = $value['info']->title;
            $value['text'] = $value['info']->text;
            $value['dates_homework'] = $value['info']->date;
            if(isset($value['info']))
                unset($value['info']);

            $value['groups'] = $associationHomeWork->where("homework_id",$value->id);
            $groups = [];
            foreach($value['groups'] as $group)
                array_push($groups, $group['group']['group_name']);
            $value['groups'] = $groups;
        }
            
        
        return $result;
    }

    public function getAssociationUsersHomeWork()
    {
        $columns = ['id', 'user_id', 'home_work_id'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->get();

        $teacherRepository = app(UserRepository::class);
        $teachers = $teacherRepository->getTeachersFIO();
        foreach($result as $key => $value)
        {
            $result[$key]['user'] = $teachers->where("id",$value['user_id'])->first()->full_name;
        }
        
        return $result;
    }
}