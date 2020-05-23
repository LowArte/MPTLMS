<?php

namespace App\Repositories\ModelRepository;

use App\Models\HomeWorkStudent as Model;
use Debugbar;

class HomeWorkStudentRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getHomeWorkStudentById($association_home_work_id, $student_id)
    {
        $columns = ['id', 'info', 'created_at as date'];
        $result = $this->startCondition()->where([['association_home_work_id', $association_home_work_id],['student_id', $student_id]])->select($columns)->toBase()->get();

        $homeWorkStudentDocumentRepository = app(HomeWorkStudentDocumentRepository::class);
        $documents = $homeWorkStudentDocumentRepository->getHomeWorkStudentDocument();
        foreach($result as $homework)
        {
            $homework->info = json_decode($homework->info);
            $homework->documents = $documents->where('home_work_student_id', $homework->id);
        }

        return $result;
    }
}