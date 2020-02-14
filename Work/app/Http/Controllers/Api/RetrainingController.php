<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\RetrainingInfoRepository;

class RetrainingController extends BaseController
{ 
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
