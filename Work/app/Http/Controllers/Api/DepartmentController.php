<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateDepartmentModification;
use App\Modifications\Delete\DeleteDepartmentModification;
use App\Modifications\Update\UpdateDepartmentModification;
use App\Repositories\ModelRepository\DepartmentRepository;
use Illuminate\Http\Request;

use Debugbar;
class DepartmentController extends BaseController
{ 
    /**
     * get departments from database
     * @return JSON
     */
    public function getDepartments(DepartmentRepository $departmentRepository)
    {
        $departments = $departmentRepository->getDepartments();
        return response()->json(compact('departments'));
    }

     /**
     * get departments for combobox from database
     * @return JSON
     */
    public function getDepartmentsForCombobox(DepartmentRepository $departmentRepository)
    {
        $departments = $departmentRepository->getDepartmentsForComboBox();
        return response()->json(compact('departments'));
    }

    public function save(Request $request,CreateDepartmentModification $createDepartmentModification){
        $data = $request->all();
        $id = $createDepartmentModification->addDepartmentToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateDepartmentModification $updateDepartmentModification){
        $data = $request->all();
        $result = $updateDepartmentModification->updateDepartmentInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteDepartmentModification $deleteDepartmentModification){
        $result = $deleteDepartmentModification->deleteDepartmentFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}