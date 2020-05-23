<?php

namespace App\Repositories\ModelRepository;

use App\Models\AssociationHomeWork as Model;
use Carbon\Carbon;
use Debugbar;

class AssociationHomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getHomeWorkExam()
    {
        $columns = ['home_work.id', 'home_work_id', 'group_id', 'user_id', 'info', 'type'];
        $result = $this->startCondition()
                        ->join("home_work", 'home_work_id', '=', 'home_work.id')
                        ->where([['home_work.type', 3],['home_work.info->date', '>=', Carbon::yesterday()]])
                        ->select($columns)
                        ->get();
        $teacherRepository = app(UserRepository::class);
        $teachers = $teacherRepository->getTeachersFIO();

        $placeRepository = app(PlaceRepository::class);
        $places = $placeRepository->getPlaces();

        $groupRepository = app(GroupRepository::class);
        $groups = $groupRepository->getGroups();
        foreach($result as $value)
        {
            $value['teacher_admin'] = $teachers->where("id",$value['user_id'])->first()->full_name_inverted;
            $value['info'] = json_decode($value['info']);
            $value['place_name'] = $places->where("id", $value['info']->place_id)->first()->place_name;
            $value['group_name'] = $groups->where("id", $value['group_id'])->first()->group_name;
        }
        
        return json_decode($result);
    }

    public function getHomeWorkByGroupId($group_id)
    {
        $columns = ['association_home_work.id as assoc_id', 'home_work.id', 'user_id', 'info', 'type', 'home_work.created_at as date', 'home_work_id', 'group_id'];
        $result = $this->startCondition()
                        ->join('home_work', 'home_work_id', '=', 'home_work.id')
                        ->where('group_id', $group_id)
                        ->select($columns)
                        ->get();
        $teacherRepository = app(UserRepository::class);
        $teachers = $teacherRepository->getTeachersFIO();

        $placeRepository = app(PlaceRepository::class);
        $places = $placeRepository->getPlaces();
        foreach($result as $value)
        {
            $value['info'] = json_decode($value['info']);
            if($value['info'])
            {
                $value['teacher_admin'] = $teachers->where("id",$value['user_id'])->first()->full_name_inverted;
                $value['title'] = $value['info']->title;
                $value['text'] = $value['info']->text;
                if($value['info']->place_id)
                    $value['place_name'] = $places->where("id", $value['info']->place_id)->first()->place_name;
                $value['dates_homework'] = $value['info']->date;
                if(isset($value['homework']))
                    unset($value['homework']);
            }
        }
        
        return json_decode($result);
    }
    //Получение задания для студента
    public function getHomeWorkStudentById($home_work_id, $group_id, $student_id)
    {
        $columns = ['association_home_work.id as association_home_work_id', 'home_work_id', 'home_work.user_id', 'info', 'type', 'home_work.created_at as date'];
        $result = $this->startCondition()
                        ->join('home_work', 'home_work_id', '=', 'home_work.id')
                        ->where([['home_work_id', $home_work_id],['group_id', $group_id]])
                        ->select($columns)
                        ->first();

        $userRepository = app(UserRepository::class);
        $users = $userRepository->getFullRuFIO();

        $placeRepository = app(PlaceRepository::class);
        $places = $placeRepository->getPlaces();

        if($result)
        {
            $result->teacher_admin = $users->where("id",$result->user_id)->first()->fullFio;
            $result = json_decode($result);
            $result->info = json_decode($result->info);
            if($result->info->place_id)
                $result->info->place_name = $places->where("id", $result->info->place_id)->first()->place_name;
        }
        return $result;
    }

    public function getAssociationHomeWorkByHomeWorkId($home_work)
    {
        $columns = ['id', 'home_work_id', 'group_id'];
        $result = $this->startCondition()
                        ->where('home_work_id', $home_work)
                        ->with("group:id,group_name")
                        ->select($columns)
                        ->get();
        return $result;
    }

    public function getAssociationHomeWork()
    {
        $columns = ['id', 'home_work_id', 'group_id'];
        $result = $this->startCondition()
                        ->with("group:id,group_name")
                        ->select($columns)
                        ->get();        
        return $result;
    }
}