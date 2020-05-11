<?php

namespace App\Modifications\Create;

use App\Models\Journal as Model;
use App\Modifications\BaseModification;
use Debugbar;


class CreateJournalModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addJournalToDatabase($request)
    {
        Debugbar::info($request);
        $journal = new Model();
        $journal->fill($request);
        $result = $journal->save();
        
        if($result)
            return $journal->id;
        return  false;
    }
}