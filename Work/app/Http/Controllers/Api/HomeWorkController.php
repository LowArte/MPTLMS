<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateHomeWorkModification;
use App\Modifications\Delete\DeleteHomeWorkModification;
use App\Modifications\Delete\DeleteAssociationHomeWorkModification;
use App\Modifications\Delete\DeleteAssociationUsersHomeWorkModification;
use App\Modifications\Delete\DeleteHomeWorkDocumentModification;
use App\Modifications\Update\UpdateHomeWorkModification;
use App\Modifications\Update\UpdateAssociationHomeWorkModification;
use App\Modifications\Update\UpdateAssociationUsersHomeWorkModification;
use App\Repositories\ModelRepository\HomeWorkRepository;
use App\Repositories\ModelRepository\AssociationUsersHomeWorkRepository;
use App\Repositories\ModelRepository\HomeWorkDocumentRepository;
use App\Helpers\HomeworkFiles\HomeworkFileFactory;

use Illuminate\Http\Request;

use Debugbar;
class HomeWorkController extends BaseController
{ 
    /**
     * Сортировка по дате по возрастанию
     */
    function sortByDate($a, $b) {
        return strcmp($a->date, $b->date);
    }
    /**
     * Преподаватель
     * @return JSON
     */
    public function getHomeWorkTeacher($user_id, HomeWorkRepository $homeworkRepository, AssociationUsersHomeWorkRepository $associationUsersHomeWorkRepository)
    {
        $home_work = $homeworkRepository->getHomeWorkTeacher($user_id);
        $association_users_home_work = $associationUsersHomeWorkRepository->getAssociationUsersHomeWorkByTeacherId($user_id); 
        $home_works = array_merge(json_decode($home_work), json_decode($association_users_home_work));
        usort($home_works, function($a, $b) {return strcmp($b->date, $a->date);});
        return response()->json(compact('home_works'));
    }
    /**
     * Получение задания по id 
     * @return JSON
     */
    public function getHomeWorkTeacherById($home_work_id, $user_id, HomeWorkRepository $homeworkRepository, AssociationUsersHomeWorkRepository $associationUsersHomeWorkRepository, HomeWorkDocumentRepository $homeworkdocumentRepository)
    {
        $home_work = $homeworkRepository->getHomeWorkTeacherById($home_work_id, $user_id);
        $documents = $homeworkdocumentRepository->getHomeWorkDocument($home_work_id);
        if($documents)
            $home_work->documents = $documents;
        return response()->json(compact('home_work'));
    }

    public function save(Request $request,CreateHomeWorkModification $createHomeWorkModification){
        $data = $request->all();
        $data['info'] = json_encode($data['info']);
        $id = $createHomeWorkModification->addHomeWorkToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateHomeWorkModification $updateHomeWorkModification){
        $data = $request->all();
        $data['info'] = json_encode($data['info']);
        $result = $updateHomeWorkModification->updateHomeWorkInDatabase($data);
        if($result)
            return response()->json(200);
        else
            return response()->json(500);
    }

    public function editAccess(Request $request,UpdateAssociationHomeWorkModification $updateAssociationHomeWorkModification, UpdateAssociationUsersHomeWorkModification $updateAssociationUsersHomeWorkModification){
        $data = $request->all();
        $groups = $updateAssociationHomeWorkModification->updateAccess($data);
        $users = $updateAssociationUsersHomeWorkModification->updateAccess($data);
        if($users && $groups)
            return response()->json(200);
        else
            return response()->json(500);
    }

    public function delete($home_work_id, DeleteHomeWorkModification $deleteHomeWorkModification, DeleteAssociationHomeWorkModification $deleteAssociationHomeWorkModification, DeleteAssociationUsersHomeWorkModification $deleteAssociationUsersHomeWorkModification, HomeworkFileFactory $homeworkFileFactory, DeleteHomeWorkDocumentModification $deleteHomeWorkDocumentModification){
        $deleteAssociationHomeWorkModification->deleteAssociationHomeWorkById($home_work_id);
        $deleteAssociationUsersHomeWorkModification->deleteAssociationUserHomeWorkById($home_work_id);
        $deleteHomeWorkDocumentModification->deleteHomeWorkByIdDocument($home_work_id);
        $homeworkFileFactory->deleteHomeworkRepository($home_work_id);
        $result = $deleteHomeWorkModification->deleteHomeWorkFromDatabase($home_work_id);
        if($result==true)
            return response()->json(200);
        else
            return response()->json(500);
    }
}