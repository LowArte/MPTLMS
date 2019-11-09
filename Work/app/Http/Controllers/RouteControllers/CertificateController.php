<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departament;
use App\Models\Student;
use App\Models\Group;

use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::where('user_id', Auth::user()['id'])->first();
        $group = Group::where("id", $student["group_id"])->first();
        $departament = Departament::where("id", $group["departaments_id"])->first();
        return view('components/certificate', [
            "info" =>
            array(
                "student" => $student,
                "dep"=>$departament,
                "group"=>$group
            )
        ]);
    }
}
