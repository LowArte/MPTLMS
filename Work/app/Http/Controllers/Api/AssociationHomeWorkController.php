<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateAssociationHomeWorkModification;
use App\Modifications\Delete\DeleteAssociationHomeWorkModification;
use App\Modifications\Update\UpdateAssociationHomeWorkModification;
use App\Repositories\ModelRepository\AssociationHomeWorkRepository;
use Illuminate\Http\Request;

use Debugbar;
class AssociationHomeWorkController extends BaseController
{ 
    /**
     * Группа
     * @return JSON
     */
    public function getHomeWorkByGroupId($group_id, AssociationHomeWorkRepository $associationHomeWorkRepository)
    {
        $home_works = $associationHomeWorkRepository->getHomeWorkByGroupId($group_id);
        usort($home_works, function($a, $b) {return strcmp($b->date, $a->date);});
        return response()->json(compact('home_works'));
    }

    /**
     * Получение расписания экзаменов
     * @return JSON
     */
    public function getHomeWorkExam(AssociationHomeWorkRepository $associationHomeWorkRepository)
    {
        $exams = $associationHomeWorkRepository->getHomeWorkExam();
        return response()->json(compact('exams'));
    }

    public function save(Request $request,CreateAssociationHomeWorkModification $createAssociationHomeWorkModification)
    {
        $data = $request->all();
        $id = $createAssociationHomeWorkModification->addAssociationHomeWorkToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateAssociationHomeWorkModification $updateAssociationHomeWorkModification){
        $data = $request->all();
        $result = $updateAssociationHomeWorkModification->updateAssociationHomeWorkInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteAssociationHomeWorkModification $deleteAssociationHomeWorkModification){
        $result = $deleteAssociationHomeWorkModification->deleteAssociationHomeWorkFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}