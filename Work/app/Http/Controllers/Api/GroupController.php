<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\DepartmentRepository;
use App\Repositories\ModelRepository\GroupRepository;

class GroupController extends BaseController
{
    /**
     * Get groups by department id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function groupByDepartmentId($id, GroupRepository $groupRepository)
    {
        $groups = $groupRepository->getGroupsForComboBoxByDepartment($id);
        return response()->json(compact('groups'));
    }

    /**
     * Get groups 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function groupForCombobox(GroupRepository $groupRepository)
    {
        $groups = $groupRepository->getGroupsForComboBox();
        return response()->json(compact("groups"));
    }

        /**
     * Get groups recursive
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function groupForComboboxRecursive(GroupRepository $groupRepository)
    {
        $groups = $groupRepository->getGroupsForComboBoxWithRecursive();
        return response()->json(compact("groups"));
    }

    /**
     * get groups from database
     * @return JSON
     */
    public function getGroups(GroupRepository $groupRepository, DepartmentRepository $departmentRepository)
    {
        $groups = $groupRepository->getGroups();
        $departments = $departmentRepository->getDepartmentsForComboBox();
        return response()->json(compact('groups', 'departments'));
    }
}
