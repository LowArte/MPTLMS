<?php

namespace App\Http\Controllers\RouteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departament;
use App\Models\Student;
use App\Models\Group;

use Illuminate\Support\Facades\Auth;

class CardController extends Controller
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
        $student = Student::where('user_id', Auth::user()['id'])->get()[0];
        $group = Group::where("id", $student["group_id"])->get()[0];
        $departament = Departament::where("id", $group["departaments_id"])->get()[0];
        return view('components/card', ["user"=>Auth::user(),"student" => $student, "group" => $group,"dep"=>$departament]);
    }
}
