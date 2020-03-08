<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ModelRepository\DepartamentRepository;
use App\Repositories\ModelRepository\GroupRepository;
use Illuminate\Http\Request;


class GroupManagementController extends BaseController
{
     /**
     * Show the application group managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(GroupRepository $groupRepository, DepartamentRepository $departamentRepository)
    {
        $groups = $groupRepository->getGroups();
        $departments = $departamentRepository->getDepartamentsForComboBox();

        return view('roles.admin.group-management', compact('groups', 'departments'));
    }    
}