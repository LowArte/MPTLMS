<?php

namespace App\Modifications\Create;

use App\Models\Journal as Model;
use App\Modifications\BaseModification;


class CreateJournalModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addJournalToDatabase($request)
    {
        $journal = new Model();
        $journal->fill($request);
        $result = $journal->save();
        if($result)
            return $journal->id;
        return  false;
    }
}