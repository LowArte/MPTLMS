<?php

namespace App\Modifications\Update;

use App\Models\User as Model;
use App\Modifications\BaseModification;

use Debugbar;

class UpdateUserModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function updateUserInDatabase($data)
    {
        $group = $this->startCondition()->find($data['id']);
        $group->fill($data);
        $result = $group->save();
        if($result)
            return true;
        return  false;
    }
}