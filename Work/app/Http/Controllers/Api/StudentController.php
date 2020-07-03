<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateStudentModification;
use App\Modifications\Delete\DeleteStudentModification;
use App\Modifications\Update\UpdateStudentModification;
use App\Repositories\ModelRepository\StudentRepository;
use Illuminate\Http\Request;

use Debugbar;
class StudentController extends BaseController
{ 
    /**
     * Получение студентов определённой группы
     * @return JSON
     */
    public function getStudentsByGroupId($group_id, StudentRepository $studentRepository)
    {
        $students = $studentRepository->getStudentsByGroupId($group_id);
        return response()->json(compact('students'));
    }

    /**
     * get StudentController from database
     * @return JSON
     */
    public function getStudent(StudentRepository $studentRepository)
    {
        $student = $studentRepository->getStudent();
        return response()->json(compact('student'));
    }

    public function save(Request $request,CreateStudentModification $createStudentModification){
        $data = $request->all();
        $id = $createStudentModification->addStudentToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateStudentModification $updateStudentModification){
        $data = $request->all();
        $result = $updateStudentModification->updateStudentInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteStudentModification $deleteStudentModification){
        $result = $deleteStudentModification->deleteStudentFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}