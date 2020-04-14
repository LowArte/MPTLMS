<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modifications\Create\CreateNewsModification;
use App\Modifications\Delete\DeleteNewsModification;
use App\Modifications\Update\UpdateNewsModification;
use App\Repositories\ModelRepository\NewsRepository;

class NewsController extends BaseController
{
    /**
     * Get news 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getNews(Request $request,NewsRepository $newsRepository)
    {
        $news = $newsRepository->getNews();
        return response()->json(compact('news'));
    }

    /**
     * Add like
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setLike($id,UpdateNewsModification $updateNewsModification)
    {
        $result = $updateNewsModification->updateLikeNewsInDatabase($id);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    /**
     * Save a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request,CreateNewsModification $createNewsModification)
    {
        $data = $request->all();
        $id = $createNewsModification->addNewsToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UpdateNewsModification $updateNewsModification)
    {
        $data = $request->all();
        $result = $updateNewsModification->updateNewsInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id,DeleteNewsModification $deleteNewsModification)
    {
        $result = $deleteNewsModification->deleteNewsFromDatabase($id);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}
