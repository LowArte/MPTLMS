<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\User;

class ListCertificateController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $cert = Certificate::get();
        for ($i=0; $i < count($cert); $i++) { 
            $user = User::where('id',$cert[$i]['user_id'])->first();
            array_push($data,[
                'id'=>$cert[$i]['id'],
                'name'=>$cert[$i]['type'],
                'email'=>$user['email'],
                'date'=>date_format( $cert[$i]['created_at'],'d/m/Y'),
                "fio"=>$user['name'].' '.$user['secName'].' '.$user['thirdName'],
                "body"=>$cert[$i]['certificates_data']
            ]);
        }       
        return view('components/list-certificate',['requests'=>$data]);
    }
}