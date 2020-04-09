<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateDepartamentModification;
use App\Modifications\Delete\DeleteDepartamentModification;
use App\Modifications\Update\UpdateDepartamentModification;
use App\Repositories\ModelRepository\DepartamentRepository;
use Illuminate\Http\Request;

use Debugbar;
class DepartamentController extends BaseController
{ 
    /**
     * get departaments from database
     * @return JSON
     */
    public function getDepartments(DepartamentRepository $departamentRepository)
    {
        $departments = $departamentRepository->getDepartaments();
        return response()->json(compact('departments'));
    }

     /**
     * get departaments for combobox from database
     * @return JSON
     */
    public function getDepartmentsForCombobox(DepartamentRepository $departamentRepository)
    {
        $departaments = $departamentRepository->getDepartamentsForComboBox();
        return response()->json(compact('departaments'));
    }

    public function save(Request $request,CreateDepartamentModification $createDepartamentModification){
        $data = $request->all();
        Debugbar::info($data);
        $id = $createDepartamentModification->addDepartamentToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateDepartamentModification $updateDepartamentModification){
        $data = $request->all();
        Debugbar::info($data);
        $result = $updateDepartamentModification->updateDepartamentInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteDepartamentModification $deleteDepartamentModification){
        $result = $deleteDepartamentModification->deleteDepartamentFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
    
}
