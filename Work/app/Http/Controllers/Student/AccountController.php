<?php

namespace App\Http\Controllers\Student;


use Illuminate\Http\Request;

class AccountController extends BaseController
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('roles.student.account-card');
    }
}
