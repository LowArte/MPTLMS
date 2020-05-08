<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateAssociationModification;
use App\Modifications\Delete\DeleteAssociationModification;
use App\Modifications\Update\UpdateAssociationModification;
use App\Repositories\ModelRepository\AssociationRepository;
use Illuminate\Http\Request;

use Debugbar;
class AssociationController extends BaseController
{ 
    /**
     * Получить актуальные журналы и ассоциации
     * @return JSON
     */
    public function getAssociation(AssociationRepository $associationRepository)
    {
        $association = $associationRepository->getAssociation();
        return response()->json(compact('association'));
    }
    /**
     * Получить актуальные журналы и ассоциации
     * @return JSON
     */
    public function getAssociationForTeacher($teacher_id, AssociationRepository $associationRepository)
    {
        $association = $associationRepository->getAssociationTeacher($teacher_id);
        return response()->json(compact('association'));
    }
    /**
     * Получить актуальные журналы и ассоциации
     * @return JSON
     */
    public function getAssociationForStudentByGroup_Id($group_id, AssociationRepository $associationRepository)
    {
        $association = $associationRepository->getAssociationGroup($group_id);
        return response()->json(compact('association'));
    }

    public function save(Request $request,CreateAssociationModification $createAssociationModification, AssociationRepository $associationRepository)
    {
        $data = $request->all();
        $check = $associationRepository->checkAssociationUnique($data);
        if($check)
            return response()->json(["error" => "Такая ассоциация уже существует!"], 500);
        $id = $createAssociationModification->addAssociationToDatabase($data);
        if($id)
            return response()->json(compact("id"),200);
        else
            return response()->json(500);
    }
    
    public function edit(Request $request,UpdateAssociationModification $updateAssociationModification){
        $data = $request->all();
        $result = $updateAssociationModification->updateAssociationInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteAssociationModification $deleteAssociationModification){
        $result = $deleteAssociationModification->deleteAssociationFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}