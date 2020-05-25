<?php

namespace App\Modifications\Create;

use App\Models\News as Model;
use App\Modifications\BaseModification;
use Illuminate\Support\Facades\Auth;
use Debugbar;

class CreateNewsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addNewsToDatabase($request)
    {
        $news = new Model();
        $news->fill($request);
        $result = $news->save();
        if($result)
            return $news->id;
        return  false;
    }
}