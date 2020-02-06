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

    public function updateUserInDatabase($id,$data)
    {
        $user = $this->startCondition()->select('id')->where([['email','=', $data['email']], ['id', '!=', $id]])->toBase()->first();
        if($user != null){
            return false;
        }

        $user = $this->startCondition()->find($id);
        $user->fill($data);
        $user->save();
        return true;
    }
}