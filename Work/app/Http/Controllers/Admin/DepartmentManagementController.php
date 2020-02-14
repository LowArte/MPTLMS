<?php

namespace App\Http\Controllers\Admin;

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
}