<?php

namespace App\Modifications\Update;

use App\Modifications\Create\CreateAssociationUsersHomeWorkModification;
use App\Models\AssociationUsersHomeWork as Model;
use App\Modifications\BaseModification;
use Debugbar;


class UpdateAssociationUsersHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateAssociationUsersHomeWorkInDatabase($data)
    {
        $associationusershomework = $this->startCondition()->find($data['id']);
        $associationusershomework->fill($data);
        $result = $associationusershomework->save();
        if($result)
            return true;
        return  false;
    }

    public function updateAccess($data)
    {
        $associations = Model::where("home_work_id", $data['home_work_id'])->get();
        foreach($associations as $association) //Удаление пользователей
        {
            $check = false;
            foreach($data['users'] as $user)
                if($association->user_id == $user)
                    $check = true;
            
            if($check == false)
                $association->delete();
        }

        $createAssociationModification = app(CreateAssociationUsersHomeWorkModification::class);
        foreach($data['users'] as $user) //Добавление пользователей
        {
            $check = false;
            foreach($associations as $association)
                if($association->user_id == $user)
                    $check = true;
            
            if($check == false)
                $createAssociationModification->addAssociationUsersHomeWorkToDatabase(['home_work_id' => $data['home_work_id'], 'user_id' => $user]);
        }
    }
}