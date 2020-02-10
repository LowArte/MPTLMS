<?php

namespace App\Http\Controllers;

use App\Repositories\ControllerRepository\HomeRepository;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomeRepository $homeRepository)
    {
        $data = $homeRepository->getDataForWelcomeHomePage();
        
        return view('welcome',$data);
    }
}
