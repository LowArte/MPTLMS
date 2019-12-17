<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use App\Models\SiteOptions;
use Illuminate\Http\Request;

use Debugbar;

class PanelControlController extends Controller
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

    public function setConfigOptions(Request $request)
    {
        $value = SiteOptions::where("option_name",$request['prop_name'])->first();
        $value["option_value"] = $request['value'];
        $value->save();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prof = SiteOptions::get();
        Debugbar::info($prof);
        return view('components/panel-control',[
            'options'=>[
                "prof"=>boolval($prof[0]['option_value'])
            ]
        ]);
    }
}