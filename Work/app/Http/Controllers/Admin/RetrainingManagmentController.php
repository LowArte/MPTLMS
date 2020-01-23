<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\RetrainingInfoRepository;
use Illuminate\Http\Request;


class RetrainingManagmentController extends BaseController
{
     /**
     * Show the application retrainingInfo managment page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(RetrainingInfoRepository $retrainingInfoRepository)
    {
        $retraining = $retrainingInfoRepository->getRetrainingInfo();
        return view('roles.admin.retraining-managment', compact('retraining'));
    }    

    /**
     * get RetrainingInfo from database
     * @return JSON
     */
    public function getRetraining(RetrainingInfoRepository $retrainingInfoRepository)
    {
        $retraining = $retrainingInfoRepository->getRetrainingInfo();
        return response()->json(compact('retraining'));
    }
}