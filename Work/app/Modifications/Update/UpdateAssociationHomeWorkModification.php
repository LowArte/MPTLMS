<?php

namespace App\Modifications\Update;

use App\Models\AssociationHomeWork as Model;
use App\Modifications\Create\CreateAssociationHomeWorkModification;
use App\Modifications\BaseModification;
use Debugbar;


class UpdateAssociationHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateAssociationHomeWorkInDatabase($data)
    {
        $associationhomework = $this->startCondition()->find($data['id']);
        $associationhomework->fill($data);
        $result = $associationhomework->save();
        if($result)
            return true;
        return  false;
    }

    public function updateAccess($data)
    {
        $associations = Model::where("home_work_id", $data['home_work_id'])->get();
        foreach($associations as $association) //Удаление групп
        {
            $check = false;
            Debugbar::info($data);
            foreach($data['groups'] as $group)
                if($association->group_id == $group)
                    $check = true;
            
            if($check == false)
                $association->delete();
        }

        $createAssociationModification = app(CreateAssociationHomeWorkModification::class);
        foreach($data['groups'] as $group) //Добавление групп
        {
            $check = false;
            foreach($associations as $association)
                if($association->group_id == $group)
                    $check = true;
            
            if($check == false)
                $createAssociationModification->addAssociationHomeWorkToDatabase(['home_work_id' => $data['home_work_id'], 'group_id' => $group, 'home_work_access' => json_encode(array())]);
        }
    }
}