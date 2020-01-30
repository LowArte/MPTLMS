<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\DepartamentRepository;
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
        $departments = $departamentRepository->getDepartaments();
        return view('roles.admin.department-management', compact('departments'));
    }    

    /**
     * get departaments from database
     * @return JSON
     */
    public function getDepartments(DepartamentRepository $departamentRepository)
    {
        $departments = $departamentRepository->getDepartaments();
        return response()->json(compact('departments'));
    }
}