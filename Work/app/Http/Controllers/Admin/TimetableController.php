<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class TimetableController extends BaseController
{
    /**
     * Show the application timetable page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('roles.admin.timetable');
    }
}
