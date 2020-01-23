<?php

namespace App\Http\Controllers\Chancellery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarningController extends BaseController
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('roles.chancellery.warning');
    }
}
