<?php

namespace App\Modifications\Update;

use App\Models\Journal as Model;
use App\Modifications\BaseModification;


class UpdateJournalModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateJournalInDatabase($data)
    {
        $journal = $this->startCondition()->find($data['id']);
        $journal->fill($data);
        $result = $journal->save();
        if($result)
            return true;
        return  false;
    }
}