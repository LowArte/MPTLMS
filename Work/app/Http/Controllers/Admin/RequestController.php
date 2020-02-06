<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class RequestController extends BaseController
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('roles.admin.requests-users');
    }
}
