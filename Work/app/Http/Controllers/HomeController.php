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
        $this->middleware('auth');
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
                "header"  => "Test", 
                "content" => "feedback/FeedbackComponent",
                "props"   => array()
            ), 
            array(
                "header"  => "Test2", 
                "content" => "feedback/FeedbackComponent",
                "props"   => array()
            ));
        return view('home', ["panel_array" => json_encode($panel_array)]);
    }
}
