<?php

namespace App\Repositories\ModelRepository;

use App\Models\News as Model;
use App\Models\Likes as LikesModel;

use Debugbar;

class NewsRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getNews($user_id)
    {
        $columns = ['id','title','text','images','links','created_at'];
        $result = $this->startCondition()
                        ->with(["comments","comments.user"])
                        ->select($columns)
                        ->get();
        foreach($result as $value)
        {
            $value['likes'] = LikesModel::where('news_id', $value->id)->count();
            if(LikesModel::where([['user_id', $user_id],['news_id', $value->id]])->first())
                $value['isLike'] = true;
            else
                $value['isLike'] = false;
        }
        Debugbar::info($result);
        return $result;
    }
}