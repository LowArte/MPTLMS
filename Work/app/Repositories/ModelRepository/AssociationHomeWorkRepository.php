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
        $columns = ['home_work.id', 'homework_id', 'group_id', 'user_id', 'info', 'type'];
        $result = $this->startCondition()
                        ->join("home_work", 'homework_id', '=', 'home_work.id')
                        ->where([['home_work.type', 3]])
                        ->select($columns)
                        ->get();
        Debugbar::info($result);
        Debugbar::info(Carbon::yesterday());
        $teacherRepository = app(UserRepository::class);
        $teachers = $teacherRepository->getTeachersFIO();

        $placeRepository = app(PlaceRepository::class);
        $places = $placeRepository->getPlaces();

        $groupRepository = app(GroupRepository::class);
        $groups = $groupRepository->getGroups();
        foreach($result as $value)
        {
            $value['teacher_admin'] = $teachers->where("id",$value['user_id'])->first()->full_name;
            $value['info'] = json_decode($value['info']);
            $value['place_name'] = $places->where("id", $value['info']->place_id)->first()->place_name;
            $value['group_name'] = $groups->where("id", $value['group_id'])->first()->group_name;
        }
        
        return json_decode($result);
    }

    public function getHomeWorkByGroupId($group_id)
    {
        $columns = ['id', 'homework_id', 'group_id', 'home_work_access'];
        $result = $this->startCondition()
                        ->with("homework:id, user_id, info, type, created_at as date")
                        ->where('group_id', $group_id)
                        ->select($columns)
                        ->get();

        foreach($result as $value)
        {
            $value['info'] = json_decode($value['info']);
            $value['title'] = $value['info']->title;
            $value['text'] = $value['info']->text;
            $value['dates_homework'] = $value['info']->date;
            if(isset($value['info']))
                unset($value['info']);
        }
        
        return json_decode($result);
    }

    public function getAssociationHomeWorkByHomeWorkId($home_work)
    {
        $columns = ['id', 'homework_id', 'group_id', 'home_work_access'];
        $result = $this->startCondition()
                        ->where('homework_id', $home_work)
                        ->with("group:id,group_name")
                        ->select($columns)
                        ->get();

        
        return $result;
    }

    public function getAssociationHomeWork()
    {
        $columns = ['id', 'homework_id', 'group_id', 'home_work_access'];
        $result = $this->startCondition()
                        ->with("group:id,group_name")
                        ->select($columns)
                        ->get();

        
        return $result;
    }
}