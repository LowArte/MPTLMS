<?php

namespace App\Http\Controllers\Chancellery;

use App\Repositories\PanelExtentionRepository;
use App\Repositories\RetrainingInfoRepository;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PanelExtentionRepository $pannel_repository, RetrainingInfoRepository $retraining_repository)
    {
        $panel_array = $pannel_repository->getPanelForDrivingSchool();
        $retraining = $retraining_repository->getRetrainingInfo();
        return view('roles.chancellery.home', compact('panel_array', 'retraining'));
    }
}
