<?php

namespace App\Modifications\Update;

use App\Models\Journal as Model;
use App\Models\Association as AssociationModel;
use App\Modifications\BaseModification;
use App\Modifications\Create\CreateAssociationModification;
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

    public function updateJournalAssociationInDatabase($data)
    {
        $journal = $this->startCondition()->find($data['id']);
        $journal->isClose = $data['isClose'];
        $result = $journal->save();
        if($result)
        {
            $associations = AssociationModel::where("journal_id", $journal->id)->get();
            foreach($associations as $association) //Удаление преподавателей
            {
                $check = false;
                foreach($data['teachers_id'] as $teacher)
                    if($association->teacher_id == $teacher)
                        $check = true;
                
                if($check == false)
                    $association->delete();
            }
            $createAssociationModification = app(CreateAssociationModification::class);
            foreach($data['teachers_id'] as $teacher) //Добавление преподавателей
            {
                $check = false;
                foreach($associations as $association)
                    if($association->teacher_id == $teacher)
                        $check = true;
                
                if($check == false)
                    $createAssociationModification->addAssociationToDatabase(['journal_id' => $journal->id, 'teacher_id' => $teacher]);
            }
            return true;
        }
        return  false;
    }

    public function updateJournalCloseInDatabase($id)
    {
        $journal = $this->startCondition()->find($id);
        $journal->isClose = null;
        $journal->save();
        return true;
    }

    public function updateJournalCloseAllInDatabase($group_id)
    {
        $journals = $this->startCondition()->where("group_id", $group_id)->get();
        foreach($journals as $journal)
        {
            $journal->isClose = null;
            $journal->save();
        }
    }
}