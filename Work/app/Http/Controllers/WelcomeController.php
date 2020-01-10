<?php

namespace App\Http\Controllers;

use App\Repositories\PanelExtentionRepository;
use App\Repositories\RetrainingInfoRepository;
use App\Repositories\SiteOptionsRepository;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PanelExtentionRepository $pannel_repository,
                          RetrainingInfoRepository $retraining_repository,
                          SiteOptionsRepository    $siteOptionsRepository)
    {
        $panel_array = $pannel_repository->getPanelForDrivingSchool();
        $retraining = $retraining_repository->getRetrainingInfo();
        $profilactic = $siteOptionsRepository->getIsProfilactic();
        return view('welcome',compact('panel_array','retraining','profilactic'));
    }
}
