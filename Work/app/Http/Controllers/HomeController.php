<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','profilactic']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $panel_array = array(
            array(
                "header"  => "Подробная информация",
                "content" => "information-page-f/DrivingSchool",
                "props"   => array()
            )
        );
        return view('home', ["panel_array" => json_encode($panel_array)]);
    }
}
