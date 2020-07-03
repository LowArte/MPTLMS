<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateAssociationUsersHomeWorkModification;
use App\Modifications\Delete\DeleteAssociationUsersHomeWorkModification;
use App\Modifications\Update\UpdateAssociationUsersHomeWorkModification;
use App\Repositories\ModelRepository\AssociationUsersHomeWorkRepository;
use Illuminate\Http\Request;

use Debugbar;
class AssociationUsersHomeWorkController extends BaseController
{ 
    /**
     * get AssociationUsersHomeWorkController from database
     * @return JSON
     */
    public function getAssociationUsersHomeWork(AssociationUsersHomeWorkRepository $associationusershomeworkRepository)
    {
        $associationusershomeworkRepository = $associationusershomeworkRepository->getAssociationUsersHomeWork();
        return response()->json(compact('associationusershomeworkRepository'));
    }

    public function save(Request $request,CreateAssociationUsersHomeWorkModification $createAssociationUsersHomeWorkModification){
        $data = $request->all();
        $id = $createAssociationUsersHomeWorkModification->addAssociationUsersHomeWorkToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateAssociationUsersHomeWorkModification $updateAssociationUsersHomeWorkModification){
        $data = $request->all();
        $result = $updateAssociationUsersHomeWorkModification->updateAssociationUsersHomeWorkInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteAssociationUsersHomeWorkModification $deleteAssociationUsersHomeWorkModification){
        $result = $deleteAssociationUsersHomeWorkModification->deleteAssociationUsersHomeWorkFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}