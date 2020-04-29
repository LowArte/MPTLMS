<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateGroupModification;
use App\Modifications\Delete\DeleteGroupModification;
use App\Modifications\Update\UpdateGroupModification;
use App\Repositories\ModelRepository\DepartmentRepository;
use App\Repositories\ModelRepository\GroupRepository;
use Debugbar;
use Illuminate\Http\Request;


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

    public function save(Request $request, CreateGroupModification $createGroupModification){
        $data = $request->all();
        $id = $createGroupModification->addGroupToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        return response()->json([],400);
    }

    public function edit(Request $request, UpdateGroupModification $updateGroupModification){
        $data = $request->all();
        $result = $updateGroupModification->updateGroupInDatabase($data);
        if($result){
            return response()->json(["success"=>true]);
        }
        return response()->json([],400);
    }

    public function delete($id, DeleteGroupModification $deleteGroupModification){
        $result = $deleteGroupModification->deleteGroupFromDatabase($id);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}
