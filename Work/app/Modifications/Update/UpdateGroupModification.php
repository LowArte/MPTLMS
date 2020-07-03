<?php

namespace App\Modifications\Update;

use App\Models\Group as Model;
use App\Modifications\BaseModification;


class UpdateGroupModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updateGroupInDatabase($data)
    {
        $group = $this->startCondition()->find($data['id']);
        $group->fill($data);
        $result = $group->save();
        if($result)
            return true;
        return  false;
    }
}