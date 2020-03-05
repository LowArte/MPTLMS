<?php

namespace App\Modifications\Create;

use App\Models\Departament as Model;
use App\Modifications\BaseModification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Hash;

class CreateDepartamentModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addDepartamentToDatabase($request)
    {
        $departament = new Model();
        // try{
            $departament->fill($request);
            // $departament->save();
        // }
        // catch(Exception $e){
        //     return false;
        // }
        return true;
    }
}