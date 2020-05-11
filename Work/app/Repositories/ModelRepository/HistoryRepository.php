<?php

namespace App\Repositories\ModelRepository;

use Panoscape\History\History as Model;

class HistoryRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getHistory()
    {
        
        $result = $this->startCondition()->first();
        $result->load("user");
        return $result;
    }

}