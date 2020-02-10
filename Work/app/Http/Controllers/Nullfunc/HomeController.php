<?php

namespace App\Http\Controllers\Nullfunc;

use App\Repositories\ControllerRepository\HomeRepository;
use Illuminate\Http\Request;

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
        return view('roles.nullfunc.home', $data);
    }
}
