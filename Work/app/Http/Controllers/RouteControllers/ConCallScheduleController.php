<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\CallSchedule;
use Debugbar;

class ConCallScheduleController extends Controller
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


    public function save(Request $request){
        for($i = 0;$i<count($request['data']);$i++){
            CallSchedule::where('id',$request['data'][$i]['id'])
            ->update(['call_schedule'=>json_encode($request['data'][$i]['call_schedule'])]);
        }
        response()->json([
            "success"=>true
        ]);
        //CallSchedule::where('id',$request['id']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callSchedule = CallSchedule::get();
        $calls = array();
        foreach($callSchedule as $call){
            array_push($calls,["place"=>Places::where("id",$call->place_id)->first(),"schedule"=>$call->call_schedule]);
        }
        Debugbar::info($calls);
        return view('components/callschedule', ["calls"=>$calls]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $callSchedule = CallSchedule::get();
        $calls = array();
        foreach($callSchedule as $call){
            array_push($calls,["place"=>Places::where("id",$call->place_id)->first(),"schedule"=>$call->call_schedule]);
        }
        Debugbar::info($calls);
        return view('components/callschedule', ["calls"=>$calls]);
    }
}