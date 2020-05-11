<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateCommentAssociationHomeWorkModification;
use App\Modifications\Delete\DeleteCommentAssociationHomeWorkModification;
use App\Modifications\Update\UpdateCommentAssociationHomeWorkModification;
use App\Repositories\ModelRepository\CommentAssociationHomeWorkRepository;
use Illuminate\Http\Request;

use Debugbar;
class CommentAssociationHomeWorkController extends BaseController
{ 
    /**
     * get CommentAssociationHomeWorkController from database
     * @return JSON
     */
    public function getCommentAssociationHomeWork(CommentAssociationHomeWorkRepository $commentassociationhomeworkRepository)
    {
        $commentassociationhomeworkRepository = $commentassociationhomeworkRepository->getCommentAssociationHomeWork();
        return response()->json(compact('commentassociationhomeworkRepository'));
    }

    public function save(Request $request,CreateCommentAssociationHomeWorkModification $createCommentAssociationHomeWorkModification){
        $data = $request->all();
        $id = $createCommentAssociationHomeWorkModification->addCommentAssociationHomeWorkToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateCommentAssociationHomeWorkModification $updateCommentAssociationHomeWorkModification){
        $data = $request->all();
        $result = $updateCommentAssociationHomeWorkModification->updateCommentAssociationHomeWorkInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteCommentAssociationHomeWorkModification $deleteCommentAssociationHomeWorkModification){
        $result = $deleteCommentAssociationHomeWorkModification->deleteCommentAssociationHomeWorkFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}