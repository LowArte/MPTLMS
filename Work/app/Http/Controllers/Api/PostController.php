<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\UsersPostRepository;

class PostController extends BaseController
{ 

    /**
     * get posts from database
     * @return JSON
     */
    public function getPosts(UsersPostRepository $usersPostRepository)
    {
        $posts = $usersPostRepository->getPosts();
        return response()->json(compact('posts'));
    }
}
