<?php

namespace App\Modifications\Update;

use App\Models\Journal as Model;
use App\Modifications\BaseModification;
use Debugbar;


class UpdateJournalModification extends BaseModification
{
    protected function getModelClass()
    {
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

    public function updateJournalCloseInDatabase($id, $close)
    {
        $journal = $this->startCondition()->find($id);
        if($close == 'true')
            $journal->isClose = 1;
        else
            $journal->isClose = 0;
        $journal->save();
        return true;
    }
}