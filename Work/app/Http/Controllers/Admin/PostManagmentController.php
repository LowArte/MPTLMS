<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UsersPostRepository;
use Illuminate\Http\Request;


class PostManagmentController extends BaseController
{
     /**
     * Show the application post managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UsersPostRepository $usersPostRepository)
    {
        $posts = $usersPostRepository->getPosts();
        return view('roles.admin.post-managment', compact('posts'));
    }    

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