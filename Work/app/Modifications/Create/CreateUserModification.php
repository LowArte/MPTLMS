<?php

namespace App\Modifications\Create;

use App\Models\User as Model;
use App\Modifications\BaseModification;
use Hash;



class CreateUserModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addUserToDatabase($data){

        $user = $this->startCondition()->select(['email'])->where('email',$data['email'])->toBase()->first();
        if($user != null){
            return false;
        }

        $user = new Model();
        $user->fill($data);
        $user->save();
        
        return true;
    }
}