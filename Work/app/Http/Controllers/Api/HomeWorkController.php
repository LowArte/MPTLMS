<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateHomeWorkModification;
use App\Modifications\Delete\DeleteHomeWorkModification;
use App\Modifications\Update\UpdateHomeWorkModification;
use App\Repositories\ModelRepository\HomeWorkRepository;
use App\Repositories\ModelRepository\AssociationUsersHomeWorkRepository;
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
        $association_users_homework = $associationUsersHomeWorkRepository->getAssociationUsersHomeWorkByTeacherId($user_id); 
        $home_works = array_merge(json_decode($home_work), json_decode($association_users_homework));
        usort($home_works, function($a, $b) {return strcmp($b->date, $a->date);});
        return response()->json(compact('home_works'));
    }
    /**
     * Преподаватель
     * @return JSON
     */
    public function getHomeWorkById($homework_id, HomeWorkRepository $homeworkRepository, AssociationUsersHomeWorkRepository $associationUsersHomeWorkRepository)
    {
        $home_work = $homeworkRepository->getHomeWorkById($homework_id);
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
        $result = $updateHomeWorkModification->updateHomeWorkInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($homework_id, DeleteHomeWorkModification $deleteHomeWorkModification){
        $result = $deleteHomeWorkModification->deleteHomeWorkFromDatabase($homework_id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}