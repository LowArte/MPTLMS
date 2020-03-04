<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\DepartamentRepository;

class DepartamentController extends BaseController
{ 
    /**
     * get departaments from database
     * @return JSON
     */
    public function getDepartments(DepartamentRepository $departamentRepository)
    {
        $departments = $departamentRepository->getDepartamentsForCRUD();
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
}
