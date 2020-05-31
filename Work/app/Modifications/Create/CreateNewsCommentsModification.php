<?php

namespace App\Modifications\Create;

use App\Models\NewsComments as Model;
use App\Modifications\BaseModification;
use Illuminate\Support\Facades\Auth;
use Debugbar;
use Storage;

class CreateNewsCommentsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addCommentToDatabase($request,$id)
    {
        $newsComments = new Model();
        $request['user_id'] = auth()->user()->id;
        $request['news_id'] = $id;
        $newsComments->fill($request);
        $result = $newsComments->save();
        if($result)
            return $newsComments;
        return  false;
    }
}