<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateHomeWorkModification;
use App\Modifications\Delete\DeleteHomeWorkModification;
use App\Modifications\Update\UpdateHomeWorkModification;
use App\Repositories\ModelRepository\HomeWorkRepository;
use Illuminate\Http\Request;

use Debugbar;
class HomeWorkController extends BaseController
{ 
    /**
     * get HomeWorkController from database
     * @return JSON
     */
    public function getHomeWork(HomeWorkRepository $homeworkRepository)
    {
        $homeworkRepository = $homeworkRepository->getHomeWork();
        return response()->json(compact('homeworkRepository'));
    }

    public function save(Request $request,CreateHomeWorkModification $createHomeWorkModification){
        $data = $request->all();
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

    public function delete($id,DeleteHomeWorkModification $deleteHomeWorkModification){
        $result = $deleteHomeWorkModification->deleteHomeWorkFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}