<?php

namespace App\Http\Controllers\Student;

use App\Repositories\PanelExtentionRepository;
use App\Repositories\RetrainingInfoRepository;
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
