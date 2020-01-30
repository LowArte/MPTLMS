<?php

namespace App\Http\Controllers\Nullfunc;

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
        return view('roles.nullfunc.home', compact('panel_array', 'retraining'));
    }
}