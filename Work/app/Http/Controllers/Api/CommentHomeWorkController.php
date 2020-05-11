<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateCommentHomeWorkModification;
use App\Modifications\Delete\DeleteCommentHomeWorkModification;
use App\Modifications\Update\UpdateCommentHomeWorkModification;
use App\Repositories\ModelRepository\CommentHomeWorkRepository;
use Illuminate\Http\Request;

use Debugbar;
class CommentHomeWorkController extends BaseController
{ 
    /**
     * get CommentHomeWorkController from database
     * @return JSON
     */
    public function getCommentHomeWork(CommentHomeWorkRepository $commenthomeworkRepository)
    {
        $commenthomeworkRepository = $commenthomeworkRepository->getCommentHomeWork();
        return response()->json(compact('commenthomeworkRepository'));
    }

    public function save(Request $request,CreateCommentHomeWorkModification $createCommentHomeWorkModification){
        $data = $request->all();
        $id = $createCommentHomeWorkModification->addCommentHomeWorkToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateCommentHomeWorkModification $updateCommentHomeWorkModification){
        $data = $request->all();
        $result = $updateCommentHomeWorkModification->updateCommentHomeWorkInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteCommentHomeWorkModification $deleteCommentHomeWorkModification){
        $result = $deleteCommentHomeWorkModification->deleteCommentHomeWorkFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}