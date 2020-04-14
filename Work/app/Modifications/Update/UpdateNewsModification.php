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

    public function updateLikeNewsInDatabase($data)
    {
        $news = $this->startCondition()->find($data['id']);   
        $like = Likes::find     
        $result = null;
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