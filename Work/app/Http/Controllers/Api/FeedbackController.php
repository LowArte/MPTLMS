<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\FeedbackRepository;
use App\Modifications\Create\CreateFeedbackModification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    /**
     * Save
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, CreateFeedbackModification $createFeedbackModification)
    {
        $data = $request->all();
        $result = $createFeedbackModification->addFeedbackToDatabase($data, Auth::user()->id);
        if($result)
            return response()->json(["success"=>true]);
        return response()->json(["success"=>true]);
    }
}