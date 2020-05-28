<?php

namespace App\Repositories\ModelRepository;

use App\Models\Department;
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

        $result = $this->startCondition()->with("user")->get();
        return $result;
    }

}