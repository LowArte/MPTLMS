<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateUserModification;
use App\Modifications\Delete\DeleteUserModification;
use App\Modifications\Update\UpdateUserModification;
use App\Modifications\Other\OtherUserModification;
use App\Repositories\ModelRepository\UserRepository;
use App\Repositories\ModelRepository\UsersPostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Debugbar;
class UserController extends BaseController
{ 

    /**
     * Получение пользователей из базы данных
     * @return JSON
     */
    public function getUsers(UserRepository $userRepository,UsersPostRepository $usersPostRepository)
    {
        $users = $userRepository->getUsers();
        $posts = $usersPostRepository->getPosts();
        return response()->json(compact('users','posts'));
    }

    public function save(Request $request,CreateUserModification $createUserModification, OtherUserModification $otherUserModification){
        $data = $request->all();
        $data['password_not_hash'] = str_random(10);
        $data['password'] = Hash::make($data['password_not_hash']);
        $id = $createUserModification->addUserToDatabase($data);
        if($id){
            $otherUserModification->sendEmailNewUser($data);
            return response()->json(compact("id"), 200);
        }
        else
            return response()->json(500);
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

    public function delete($id,$post_id, DeleteUserModification $deleteUserModification){
        $result = $deleteUserModification->deleteUserFromDatabase($id, $post_id);
        if($result==true){
            return response()->json(200);
        }
        else{
            return response()->json(500);
        }
    }
}