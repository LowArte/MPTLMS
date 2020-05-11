<?php

namespace App\Repositories\ModelRepository;

use Debugbar;
use Panoscape\History\History as Model;

class HistoryRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getHistory()
    {
        $result = $this->startCondition()->get();
        // foreach($result as $res){
        //     $res['user'] = $res->user();
        //     $res['model'] = $res->model();
        // }
        return $result;
    }

}