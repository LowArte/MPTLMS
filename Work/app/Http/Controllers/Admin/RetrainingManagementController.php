<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ModelRepository\RetrainingInfoRepository;
use Illuminate\Http\Request;


class RetrainingManagementController extends BaseController
{
     /**
     * Show the application retrainingInfo managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(RetrainingInfoRepository $retrainingInfoRepository)
    {
        $retraining = $retrainingInfoRepository->getRetrainingInfo();
        return view('roles.admin.retraining-management', compact('retraining'));
    }    
}