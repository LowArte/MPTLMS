<?php

namespace App\Http\Controllers\Unit;

use App\Modifications\Create\CreateFeedbackModification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends BaseController
{
    /**
     * Show feedback page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.chancellery.feedback');
    }
    /**
     * Save
     *
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