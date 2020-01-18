<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class WarningController extends BaseController
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('roles.admin.warning');
    }
}
