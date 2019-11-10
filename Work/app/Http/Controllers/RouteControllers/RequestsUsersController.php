<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;

use App\Models\Feedback;
use App\Notifications\AnswerForRequest;
use App\User;
use Debugbar;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RequestsUsersController extends Controller
{
    use Notifiable;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendEmail(Request $request)
    {
        $user = User::where('email',$request['to'])->first();
        $feed = Feedback::where('id',$request['id'])->first();
        $user->notify(new AnswerForRequest($request['text'],Auth::user()['email']));
        $feed['answered'] = true;
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
        $feed = Feedback::where('answered',"0")->get();
        $data = array();
        for ($i = 0; $i < count($feed); $i++) {
            $user = User::where('id',$feed[$i]['user_id'])->first();
            array_push($data,[
                "id" => $feed[$i]['id'],
                "name"=>$feed[$i]['type'],
                "date"=>date_format( $feed[$i]['created_at'],'d/m/Y'),
                "body"=>$feed[$i]['text'],
                "fio"=>$user['name'].' '.$user['secName'].' '.$user['thirdName'],
                "email"=>$user['email'],
                ]);
        }
        return view('components/requestsusers', ["requests" => $data]);
    }
}
