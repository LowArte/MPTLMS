<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateAssociationHomeWorkModification;
use App\Modifications\Delete\DeleteAssociationHomeWorkModification;
use App\Modifications\Update\UpdateAssociationHomeWorkModification;
use App\Repositories\ModelRepository\AssociationHomeWorkRepository;
use App\Repositories\ModelRepository\HomeWorkDocumentRepository;
use App\Repositories\ModelRepository\HomeWorkStudentRepository;
use Illuminate\Http\Request;
date_default_timezone_set('Europe/Moscow');

use Debugbar;
class AssociationHomeWorkController extends BaseController
{ 
    /**
     * Возвращает задания для группы
     * @return JSON
     */
    public function getHomeWorkByGroupId($group_id, AssociationHomeWorkRepository $associationHomeWorkRepository)
    {
        $home_works = $associationHomeWorkRepository->getHomeWorkByGroupId($group_id);
        return response()->json(compact('home_works'));
    }

    /**
     * Возвращает задание для группы и конкретного студента
     * @return JSON
     */
    public function getHomeWorkStudentById($home_work_id, $group_id, $student_id, AssociationHomeWorkRepository $associationHomeWorkRepository, HomeWorkDocumentRepository $homeworkdocumentRepository, HomeWorkStudentRepository $homeWorkStudentRepository)
    {
        $home_work = $associationHomeWorkRepository->getHomeWorkStudentById($home_work_id, $group_id, $student_id);
        if($home_work)
        {
            $documents = $homeworkdocumentRepository->getHomeWorkDocument($home_work_id); //Получение документов от преподавателя
            if($documents)
                $home_work->documents = $documents;
            if($home_work)
            {
                $home_work_student = $homeWorkStudentRepository->getHomeWorkStudentById($home_work->association_home_work_id, $student_id);
                if($home_work_student)
                    $home_work->home_work_student = $home_work_student;
            }
        }
        return response()->json(compact('home_work'));
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
        $id = $createAssociationHomeWorkStudentModification->addAssociationHomeWorkToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
        return response()->json(500);
    }
    
    public function edit(Request $request,UpdateAssociationHomeWorkModification $updateAssociationHomeWorkModification){
        $data = $request->all();
        $datetime = date("Y-m-d H:i:s");
        $data['datetime'] = $datetime;
        $result = $updateAssociationHomeWorkModification->updateAssociationHomeWorkStudentInDatabase($data);
        if($result){
            return response()->json(compact('datetime'), 200);
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