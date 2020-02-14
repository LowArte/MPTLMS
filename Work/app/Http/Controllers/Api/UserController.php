<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\UserRepository;
use App\Repositories\ModelRepository\UsersPostRepository;

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
}
