<?php

namespace App\Http\Controllers\Chancellery;

use App\Repositories\ControllerRepository\HomeRepository;
use App\Repositories\DepartamentRepository;
use App\Repositories\PanelExtentionRepository;
use App\Repositories\RetrainingInfoRepository;

class HomeController extends BaseController
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomeRepository $homeRepository)
    {        
        $data = $homeRepository->getDataForDefaultHomePage();
        return view('roles.chancellery.home', $data);
    }
}
