<?php

namespace App\Http\Controllers\Admin;

class RequestController extends BaseController
{
    /**
     * Show the application request of user page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('roles.admin.requests-users');
    }
}