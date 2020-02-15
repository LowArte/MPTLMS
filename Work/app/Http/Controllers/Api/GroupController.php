<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\DepartamentRepository;
use App\Repositories\ModelRepository\GroupRepository;

class GroupController extends BaseController
{ 
    /**
     * Get groups by departament id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function groupByDepartamentId($id, GroupRepository $groupRepository)
    {
        $groups = $groupRepository->getGroupsForComboBoxByDepartament($id);
        return response()->json(array(
            "groups_info"=>array(
                "groups"=>$groups,
                "selected_group"=>$groups[0]
            ),
        ));
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