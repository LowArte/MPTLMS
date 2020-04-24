<?php

namespace App\Modifications\Create;

use App\Models\UsersPost as Model;
use App\Modifications\BaseModification;


class CreatePostModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addPostToDatabase($request)
    {
        $post = new Model();
        $post->fill($request);
        $result = $post->save();
        if($result)
            return $post->id;
        return  false;
    }
}