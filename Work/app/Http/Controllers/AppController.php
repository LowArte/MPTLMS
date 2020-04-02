<?php

namespace App\Http\Controllers;

use App\Repositories\ModelRepository\SiteOptionsRepository;

class AppController extends Controller
{
        /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(SiteOptionsRepository $siteOptionsRepository)
    {    
        $Profilactic = $siteOptionsRepository->getIsProfilactic();
        return view('layouts.app',["Profilactic"=>$Profilactic]);
    }
}
