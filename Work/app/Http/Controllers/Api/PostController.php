<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Update\UpdatePostModification;
use App\Repositories\ModelRepository\UsersPostRepository;
use Illuminate\Http\Request;

use Debugbar;

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

    /**
     * get posts from database
     * @return JSON
     */
    public function getPostsFull(UsersPostRepository $usersPostRepository)
    {
        $posts = $usersPostRepository->getPostsFull();
        Debugbar::info($posts);
        return response()->json(compact('posts'));
    }

    /**
     * get posts from database
     * @return JSON
     */
    public function getPostsForManagement(UsersPostRepository $usersPostRepository)
    {
        $posts = $usersPostRepository->getPostsForManagement();
        return response()->json(compact('posts'));
    }

    public function edit(Request $request, UpdatePostModification $updatePostModification){
        $data = $request->all();
        $result = $updatePostModification->updatePostInDatabase($data);
        if($result){
            return response()->json(["success"=>true]);
        }
        return response()->json([],400);
    }
}
