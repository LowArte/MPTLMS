<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DepartamentRepository;
use Illuminate\Http\Request;


class DepartmentManagmentController extends BaseController
{
     /**
     * Show the application user managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(DepartamentRepository $departamentRepository)
    {
        $departments = $departamentRepository->getDepartamentsForComboBox();
        return view('roles.admin.department-managment', compact('departments'));
    }    

    /**
     * get departaments from database
     * @return JSON
     */
    public function getDepartaments(DepartamentRepository $departamentRepository)
    {
        $departments = $departamentRepository->getDepartamentsForComboBox();
        return response()->json(compact('departments'));
    }
}