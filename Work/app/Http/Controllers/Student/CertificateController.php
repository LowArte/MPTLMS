<?php

namespace App\Http\Controllers\Student;

use App\Repositories\ModelRepository\CertificateRepository;
use App\Modifications\Create\CreateCertificateModification;
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
    public function save(Request $request, CreateCertificateModification $createCertificateModification)
    {
        $result = $createCertificateModification->addCertificateToDatabase($request);
        if ($result)
            return response()->json(["success"=>true]);
    }
}