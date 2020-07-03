<?php

namespace App\Modifications\Update;

use App\Models\News as Model;
use App\Models\Likes;
use App\Modifications\BaseModification;

use Debugbar;
use Exception;

class UpdateNewsModification extends BaseModification
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function updateLikeNewsInDatabase($id)
    { 
        $user = auth()->user();
        $like = Likes::where(["user_id",$user->id],["news_id",$id])->first();     
        if($like){
            $like->value = !$like->value;
        }
        else{
            $like = new Likes();
            $like->user_id = $user->id;
            $like->news_id = $id;
            $like->value = true;
        }
        $result = $like->save();
        if($result)
            return true;
        return  false;
    }

    public function updateNewsInDatabase($data)
    {
        $news = $this->startCondition()->find($data['id']);
        $news->fill($news);
        $result = $news->save();
        if($result)
            return true;
        return  false;
    }
}