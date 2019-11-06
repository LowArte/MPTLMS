<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherHomeworkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('components/teacherhomework');
    }
}
