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
        switch ($request['isClose']) 
        {
            case 2:
                $request['journal'] = json_encode(['2' => []]);
                break;
            case 1:
                $request['journal'] = json_encode(['1' => []]);
                break;
            case 0:
                $request['journal'] = json_encode(['1' => [], '2' => []]);
                break;
            default:
                $request['journal'] = json_encode([]);
                break;
        }
        $journal = new Model();
        $journal->fill($request);
        $result = $journal->save();
        
        if($result)
        {
            $createAssociationModification = app(CreateAssociationModification::class);
            foreach($request['teachers'] as $value)
                $createAssociationModification->addAssociationToDatabase(['journal_id' => $journal->id, 'teacher_id' => $value]);
            return $journal->id;
        }
        return  false;
    } 
}