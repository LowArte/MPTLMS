<?php

namespace App\Modifications\Create;

use App\Models\Group as Model;
use App\Modifications\BaseModification;


class CreateGroupModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addGroupToDatabase($request)
    {
        $group = new Model();
        $group->fill($request);
        $result = $group->save();
        if($result)
            return $group->id;
        return  false;
    }
}