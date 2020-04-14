<?php

namespace App\Repositories\ModelRepository;

use App\Models\News as Model;

use Debugbar;

class NewsRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getNews()
    {
        $columns = ['id','title','text','images','links'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->with("likes")
                        ->get();
        return $result;
    }
}