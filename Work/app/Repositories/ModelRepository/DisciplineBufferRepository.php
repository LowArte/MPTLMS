<?php

namespace App\Repositories\ModelRepository;

use App\Helpers\SQLite\SQLiteDBFunctions;
use App\Models\DisciplineBuffer as Model;
use Debugbar;

class DisciplineBufferRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getDisciplineBufferRepository()
    {
        $columns = ['id', 'db_name','created_at'];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }

    public function getDisciplineBufferRepositoryData($dbName)
    {
        Debugbar::info($dbName);
        $db = new SQLiteDBFunctions($dbName);
        $result = $db->getData();
        return $result;
    }
}