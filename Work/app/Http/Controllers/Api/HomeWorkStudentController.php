<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateHomeWorkStudentModification;
use App\Modifications\Delete\DeleteHomeWorkStudentModification;
use App\Modifications\Update\UpdateHomeWorkStudentModification;
use App\Repositories\ModelRepository\HomeWorkStudentRepository;
use Illuminate\Http\Request;

use Debugbar;

class HomeWorkStudentController extends BaseController
{ 
    /**
     * Получение домашнего заданя
     * @return JSON
     */
    public function getHomeWorkStudent(HomeWorkStudentRepository $homeworkstudentRepository)
    {
        $homeworkstudentRepository = $homeworkstudentRepository->getHomeWorkStudent();
        return response()->json(compact('homeworkstudentRepository'));
    }

    public function save(Request $request,CreateHomeWorkStudentModification $createHomeWorkStudentModification){
        $data = $request->all();
        $data['info'] = json_encode($data['info']);
        $id = $createHomeWorkStudentModification->addHomeWorkStudentToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateHomeWorkStudentModification $updateHomeWorkStudentModification){
        $data = $request->all();
        if($data)
            $data['info'] = json_encode($data['info']);
        $result = $updateHomeWorkStudentModification->updateHomeWorkStudentInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteHomeWorkStudentModification $deleteHomeWorkStudentModification){
        $result = $deleteHomeWorkStudentModification->deleteHomeWorkStudentFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}