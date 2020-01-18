<?php

namespace App\Http\Controllers;

use App\Repositories\PanelExtentionRepository;
use App\Repositories\RetrainingInfoRepository;
use App\Repositories\SiteOptionsRepository;
use Illuminate\Http\Request;

class WarningController extends Controller
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('warning');
    }
}
