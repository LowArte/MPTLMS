<?php

namespace App\Modifications\Update;

use App\Models\UsersPost as Model;
use App\Modifications\BaseModification;

use Debugbar;
use Exception;

class UpdatePostModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updatePostInDatabase($data)
    {
        Debugbar::info($data);
        if($data['privilegies'])
        {
            $data['privilegies'][0]['component']['info']['url'] = "";
        }
        Debugbar::info($data);
        $post = $this->startCondition()->find($data['id']);
        try{
            $post->fill($data);
            $post->save();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
}