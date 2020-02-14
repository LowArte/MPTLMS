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
}
