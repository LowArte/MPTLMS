<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateHomeWorkStudentDocumentModification;
use App\Modifications\Delete\DeleteHomeWorkStudentDocumentModification;
use App\Modifications\Update\UpdateHomeWorkStudentDocumentModification;
use App\Repositories\ModelRepository\HomeWorkStudentDocumentRepository;
use Illuminate\Http\Request;
use Storage;

use Debugbar;
class HomeWorkStudentDocumentController extends BaseController
{ 
    /**
     * get HomeWorkStudentDocumentController from database
     * @return JSON
     */
    public function getHomeWorkStudentDocument(HomeWorkStudentDocumentRepository $homeworkstudentdocumentRepository)
    {
        $homeworkstudentdocumentRepository = $homeworkstudentdocumentRepository->getHomeWorkStudentDocument();
        return response()->json(compact('homeworkstudentdocumentRepository'));
    }

    public function save($home_work_id, $home_work_student_id, $student_id, Request $request,CreateHomeWorkStudentDocumentModification $createHomeWorkStudentDocumentModification){
        $files = request()->file();
        foreach ($files as $file) {
            $file_name = $file->getClientOriginalName();
            $path = Storage::disk('homework')->putFile('./'.$home_work_id.'/students/'.$student_id, $file);
            
            $createHomeWorkStudentDocumentModification->addHomeWorkStudentDocumentToDatabase([
                'home_work_student_id' => $home_work_student_id,
                'path' => $path,
                'name' => $file_name
            ]);
        }
        return response()->json(200);
    }

    public function getDocument($id, HomeWorkStudentDocumentRepository $homeWorkStudentDocumentRepository)
    {
        $path = $homeWorkStudentDocumentRepository->getHomeWorkPathDocument($id);
        return Storage::disk('homework')->download("./".$path);
    }
    
    public function edit(Request $request,UpdateHomeWorkStudentDocumentModification $updateHomeWorkStudentDocumentModification){
        $data = $request->all();
        $result = $updateHomeWorkStudentDocumentModification->updateHomeWorkStudentDocumentInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteHomeWorkStudentDocumentModification $deleteHomeWorkStudentDocumentModification){
        $result = $deleteHomeWorkStudentDocumentModification->deleteHomeWorkStudentDocumentFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}