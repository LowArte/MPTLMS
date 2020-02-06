<?php

namespace App\Http\Controllers\Admin;


use App\Modifications\Create\CreateUserModification;
use App\Modifications\Delete\DeleteUserModification;
use App\Modifications\Update\UpdateUserModification;
use App\Repositories\UserRepository;
use App\Repositories\UsersPostRepository;
use Illuminate\Http\Request;


class UserManagementController extends BaseController
{
     /**
     * Show the application user managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UserRepository $userRepository,UsersPostRepository $usersPostRepository)
    {
        $users = $userRepository->getUsers();
        $posts = $usersPostRepository->getPosts();
        return view('roles.admin.user-management',compact('users','posts'));
    }

    /**
     * get user from database
     * @return JSON
     */
    public function getUsers(UserRepository $userRepository,UsersPostRepository $usersPostRepository)
    {
        $users = $userRepository->getUsers();
        $posts = $usersPostRepository->getPosts();
        return response()->json(compact('users','posts'));
    }

    /**
     * save user from database
     * @param id user id
     * @return JSON
     */
    public function save(Request $request,CreateUserModification $createUserModification)
    {
        $data = $request->all();
        $result = $createUserModification->addUserToDatabase($data['user']);
        if($result){
            return response()->json(["success"=>true]);
        }
        return response()->json(["error"=>"Такой почтовый адресс уже существует"],400);
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
        $result = $updateUserModification->updateUserInDatabase($id,$data['user']);
        if($result){
            return response()->json(["success"=>true]);
        }
        return response()->json(["error"=>"Такой почтовый адресс уже существует"],400);
    }
}
