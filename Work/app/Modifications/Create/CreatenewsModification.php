<?php

namespace App\Modifications\Create;

use App\Models\News as Model;
use App\Modifications\BaseModification;
use Illuminate\Support\Facades\Auth;
use Debugbar;
use Storage;

class CreateNewsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function addNewsToDatabase($request,$files)
    {
        $news = new Model();
        $images = [];
        foreach ($files as $image) {
            array_push($images,["name"=>$image->getClientOriginalName()]);
        }
        $request['images'] =  json_encode($images);
        $news->fill($request);
        $result = $news->save();
        if($result)
        {
            $this->saveFile($news->id,$files);
            return $news->id;
        }
        return  false;
    }

    private function saveFile($id,$images){
        foreach ($images as $image) {
            $content = file_get_contents($image->getRealPath());
            Storage::disk("news")->put($id."//".$image->getClientOriginalName(),$content);
        }
    }
}