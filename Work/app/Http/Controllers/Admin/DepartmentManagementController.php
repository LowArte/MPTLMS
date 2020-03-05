<?php

namespace App\Http\Controllers\Admin;

use App\Modifications\Create\CreateDepartamentModification;
use App\Modifications\Delete\DeleteDepartamentModification;
use App\Modifications\Update\UpdateDepartamentModification;
use App\Repositories\ModelRepository\DepartamentRepository;
use Illuminate\Http\Request;


class DepartmentManagementController extends BaseController
{
     /**
     * Show the application department managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(DepartamentRepository $departamentRepository)
    {
        $departments = $departamentRepository->getDepartamentsForCRUD();
        
        $headers = [['text' => "Наименование", 'value' => "dep_name_full"],['text' => "Действия", 'value' => "action", 'sortable' => false]];
        return view('roles.admin.department-management', compact('departments'), compact('headers'));
    }    

    public function save(Request $request,CreateDepartamentModification $createDepartamentModification){
        $data = $request->all();
        $result = $createDepartamentModification->addDepartamentToDatabase($data);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateDepartamentModification $updateDepartamentModification){
        $data = $request->all();
        $result = $updateDepartamentModification->updateDepartamentInDatabase($data['id'],$data);
        if($result==true){
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

    public function deleteAll(DeleteDepartamentModification $deleteDepartamentModification){
        print_r("asda");
        $result = $deleteDepartamentModification->deleteAllDepartamentFromDatabase();

        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}