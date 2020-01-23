<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\GroupRepository;
use App\Repositories\DepartamentRepository;
use Illuminate\Http\Request;


class GroupManagmentController extends BaseController
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
        return view('roles.admin.group-managment', compact('groups', 'departments'));
    }    

    /**
     * get groups from database
     * @return JSON
     */
    public function getGroups(GroupRepository $groupRepository, DepartamentRepository $departamentRepository)
    {
        $groups = $groupRepository->getGroups();
        $departments = $departamentRepository->getDepartamentsForComboBox();
        return response()->json(compact('groups', 'departments'));
    }
}