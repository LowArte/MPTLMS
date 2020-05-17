<?php

namespace App\Modifications\Create;

use App\Models\HomeWork as Model;
use App\Modifications\BaseModification;


class CreateHomeWorkModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addHomeWorkToDatabase($request)
    {
        $homework = new Model();
        $homework->fill($request);
        $result = $homework->save();
        if($result)
        {
            $createAssociationHomeWorkModification = app(CreateAssociationHomeWorkModification::class);
            foreach($request['groups_id'] as $value)
                $createAssociationHomeWorkModification->addAssociationHomeWorkToDatabase(['homework_id' => $homework->id, 'group_id' => $value, 'home_work_access' => json_encode(array())]);

                $сreateAssociationUsersHomeWorkModification = app(CreateAssociationUsersHomeWorkModification::class);
                foreach($request['teachers'] as $value)
                    $сreateAssociationUsersHomeWorkModification->addAssociationUsersHomeWorkToDatabase(['home_work_id' => $homework->id, 'user_id' => $value, 'access' => 0]);
            return $homework->id;
        }
        return  false;
    }
}