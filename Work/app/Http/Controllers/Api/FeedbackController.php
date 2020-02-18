<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\FeedbackRepository;

class FeedbackController extends BaseController
{ 
    /**
     * get feedback from database
     * @return JSON
     */
    public function getFeedbackRequests(FeedbackRepository $feedbackRepository)
    {
        $feedback = $feedbackRepository->getFeedback();
        return response()->json(compact('feedback'));
    }
}