<?php

namespace App\Repositories\ModelRepository;

use App\Models\HomeWorkStudentDocument as Model;

class HomeWorkStudentDocumentRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getHomeWorkStudentDocument()
    {
        $columns = ['id', 'name', 'home_work_student_id'];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }

    public function getHomeWorkPathDocument($id)
    {
        $result = $this->startCondition()->where('id', $id)->first()->path;
        return $result;
    }
}