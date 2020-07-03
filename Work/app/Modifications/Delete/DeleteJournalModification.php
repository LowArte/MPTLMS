<?php

namespace App\Modifications\Delete;
use App\Models\Journal as Model;
use App\Modifications\BaseModification;

class DeleteJournalModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function deleteJournalFromDatabase($id){
        $result = $this->startCondition()->find($id)->delete();
        return $result;
    }
}