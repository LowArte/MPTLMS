<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','profilactic']);
    }

    /**
     * Add new feedback to database
     * 
     * @return \Illuminate\Http\Response
     */
    public function savefeedback(Request $request)
    {
        $feed = new Feedback();
        $feed['user_id'] = Auth::user()['id'];
        $feed['type'] = $request['type'];
        $feed['text'] = $request['text'];
        $feed['answered'] = 0;
        $feed->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('components/feedback');
    }
}
