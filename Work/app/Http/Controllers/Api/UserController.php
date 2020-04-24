<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateUserModification;
use App\Modifications\Delete\DeleteUserModification;
use App\Modifications\Update\UpdateUserModification;
use App\Repositories\ModelRepository\UserRepository;
use App\Repositories\ModelRepository\UsersPostRepository;
use Illuminate\Http\Request;

use Debugbar;
class UserController extends BaseController
{ 

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

    public function save(Request $request,CreateUserModification $createUserModification){
        $data = $request->all();
        Debugbar::info($data);
        $id = $createUserModification->addUserToDatabase($data);
        if($id){
            return response()->json(compact("id"),200);
        }
        else{
            return response()->json(500);
        }
    }
    
    public function edit(Request $request,UpdateUserModification $updateUserModification){
        $data = $request->all();
        Debugbar::info($data);
        $result = $updateUserModification->updateUserInDatabase($data);
        if($result){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }

    public function delete($id,DeleteUserModification $deleteUserModification){
        $result = $deleteUserModification->deleteUserFromDatabase($id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}