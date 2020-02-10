<?php

namespace App\Http\Controllers\Student;

use App\Repositories\ModelRepository\CertificateRepository;
use Illuminate\Http\Request;


class CertificateController extends BaseController
{
     /**
     * Show the application certificate page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('roles.student.certificate');
    }    

    /**
     * save from database
     * @return JSON
     */
    public function save()
    {
        return response()->json();
    }
}