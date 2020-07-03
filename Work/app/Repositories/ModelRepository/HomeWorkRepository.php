<?php

namespace App\Repositories\ModelRepository;

use App\Models\HomeWork as Model;
use Debugbar;

class HomeWorkRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getHomeWorkTeacherById($home_work_id, $user_id)
    {
        $columns = ['id', 'user_id', 'info', 'type', 'created_at as date'];
        $result = $this->startCondition()
                        ->where('id', $home_work_id)
                        ->with('associationHomework:id,home_work_id,group_id')
                        ->with('associationUserHomework:home_work_id,user_id')
                        ->select($columns)
                        ->orderBy('id', 'desc')
                        ->first();
        //Получение ассоциаций домашних заданий
        $groupRepository = app(GroupRepository::class);
        $groups = $groupRepository->getGroups();

        $userRepository = app(UserRepository::class);
        $users = $userRepository->getFullRuFIO();

        $associationRepository = app(AssociationRepository::class);

        $placeRepository = app(PlaceRepository::class);
        $places = $placeRepository->getPlaces();

        $studentsRepository = app(StudentRepository::class);
        $students = $studentsRepository->getStudents();

        $homeWorkStudentRepository = app(HomeWorkStudentRepository::class);

        if($result)
        {
            $result = json_decode($result);
            $result->info = json_decode($result->info);
            if($result->info->place_id)
                $result->info->place_name = $places->where("id", $result->info->place_id)->first()->place_name;
            $journals = [];

            if($result->association_homework)
                foreach($result->association_homework as $homework)
                {
                    $homework->students = $students->where("group_id", $homework->group_id);
                    $students_homeworks = $homeWorkStudentRepository->getHomeWorkStudent($homework->id);
                    foreach($homework->students as $student)
                        $student->homework = $students_homeworks->where('student_id', $student->id);

                    $homework->group_name = $groups->where("id",$homework->group_id)->first()->group_name;
                    $journal = $associationRepository->getAssociationAndJournalByGroupAndUserId($homework->group_id, $user_id);
                    if($journal)
                        foreach($journal as $item)
                            array_push($journals, $item);
                }

            if($result->association_user_homework)
                foreach($result->association_user_homework as $user)
                    $user->full_fio = $users->where("id",$user->user_id)->first()->fullFio;
            $result->journals = $journals;
        }
        return $result;
    }

    public function getHomeWorkTeacher($user_id)
    {
        $columns = ['id', 'info', 'type', 'created_at as date'];
        $result = $this->startCondition()
                        ->where('user_id', $user_id)
                        ->select($columns)
                        ->orderBy('id', 'desc')
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
            foreach($associationHomeWork->where("home_work_id",$value->id) as $group)
                array_push($groups, $group['group']['group_name']);
            
            $value['groups'] = $groups;
        }
        return $result;
    }
}