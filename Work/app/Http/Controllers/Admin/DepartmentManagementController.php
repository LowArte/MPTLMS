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
        
        $headers = [['text' => "Наименование", 'value' => "dep_name_full"],['text' => "Действия", 'value' => "action", 'sortable' => false]];
        return view('roles.admin.department-management', compact('departments'), compact('headers'));
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