<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modifications\Create\CreateNewsModification;
use App\Modifications\Delete\DeleteNewsModification;
use App\Modifications\Create\CreateLikesModification;
use App\Modifications\Create\CreateNewsCommentsModification;
use App\Modifications\Delete\DeleteLikesModification;
use App\Modifications\Update\UpdateNewsModification;
use App\Repositories\ModelRepository\NewsRepository;
use App\Repositories\ModelRepository\LikesRepository;
use Debugbar;

class NewsController extends BaseController
{
    /**
     * Получение новостей
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getNews($user_id,NewsRepository $newsRepository)
    {
        $news = $newsRepository->getNews($user_id);
        return response()->json(compact('news'));
    }

    /**
     * Добавление лайка
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setLike(Request $request,CreateLikesModification $createLikesModification, DeleteLikesModification $deleteLikesModification, LikesRepository $likesRepository)
    {
        $data = $request->all();
        if($likesRepository->getLikesForUser($data['new_id'], $data['user_id']) == null)
            $result = $createLikesModification->addLikeToDatabase($data['new_id'], $data['user_id']);
        else
            $result = $deleteLikesModification->deleteLikesFromDatabase($data['user_id'], $data['new_id']);

        $count = $likesRepository->getLikesCount($data['new_id']);
        if($result)
            return response()->json(compact('count'), 200);
        else
            return response()->json(500);
    }

    /**
     * Сохранение новости
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request,CreateNewsModification $createNewsModification)
    {
        $data = $request->all();
        $files = $request->file();
        $id = $createNewsModification->addNewsToDatabase($data,$files);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }

    /**
     * Редактирование новости
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
     * Удаление новости
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

    /**
     * Добавление комментария
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addComment($id,Request $request,CreateNewsCommentsModification $createNewsCommentsModification)
    {
        $data = $request->all();
        $comment = $createNewsCommentsModification->addCommentToDatabase($data,$id);
        if($comment){
            $comment->load("user");
            return response()->json(compact("comment"),200);
        }
        else{
            return response()->json(500);
        }
    }
}
