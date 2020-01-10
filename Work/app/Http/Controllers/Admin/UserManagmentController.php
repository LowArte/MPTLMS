<?php

namespace App\Http\Controllers\Admin;


use App\Modifications\Create\CreateUserModification;
use App\Modifications\Delete\DeleteUserModification;
use App\Modifications\Update\UpdateUserModification;
use Illuminate\Http\Request;

class UserManagmentController extends BaseController
{
     /**
     * Show the application user managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('roles.admin.user-managment');
    }
    /**
     * save user from database
     * @param id user id
     * @return JSON
     */
    public function save(Request $request,CreateUserModification $createUserModification)
    {
        $data = $request->all();
        $result = $createUserModification->addUserToDatabase($data);
        if($result){
            return response()->json(["success"=>true]);
        }
        return response()->json([],400);
    }
    /**
     * delete user from database
     * @param id user id
     * @return JSON
     */
    public function delete($id,DeleteUserModification $deleteUserModification)
    {
        $result = $deleteUserModification->deleteUserFromDatabase($id);
        if($result)
        {
            return response()->json(["success"=>true]);
        }
        return response()->json([],400);
    }
    /**
     * update user from database
     * @param id user id
     * @return JSON
     */
    public function edit($id,Request $request,UpdateUserModification $updateUserModification)
    {
        $data = $request->all();
        $result = $updateUserModification->updateUserInDatabase($id,$data);
        if($result){
            return response()->json(["success"=>true]);
        }
        return response()->json([],400);
    }
}
