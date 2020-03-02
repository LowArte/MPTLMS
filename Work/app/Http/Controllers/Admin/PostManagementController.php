<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ModelRepository\UsersPostRepository;
use Illuminate\Http\Request;


class PostManagementController extends BaseController
{
     /**
     * Show the application post managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UsersPostRepository $usersPostRepository)
    {
        $posts = $usersPostRepository->getPostsForManagement();
        return view('roles.admin.post-management', compact('posts'));
    }    
}