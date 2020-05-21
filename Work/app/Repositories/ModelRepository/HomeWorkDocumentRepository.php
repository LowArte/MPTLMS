<?php

namespace App\Repositories\ModelRepository;

use App\Models\HomeWorkDocument as Model;

class HomeWorkDocumentRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getHomeWorkDocument($home_work_id)
    {
        $columns = ['id', 'name'];
        $result = $this->startCondition()->where('home_work_id', $home_work_id)->select($columns)->toBase()->get();
        return $result;
    }

    public function getHomeWorkPathDocument($id)
    {
        $result = $this->startCondition()->where('id', $id)->first()->path;
        return $result;
    }
}