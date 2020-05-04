<?php

namespace App\Repositories\ModelRepository;

use App\Models\Journal as Model;

class JournalRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getJournal()
    {
        $columns = [];
        $result = $this->startCondition()->select($columns)->get();
        return $result;
    }
}