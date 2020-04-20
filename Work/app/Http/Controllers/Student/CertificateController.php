<?php

namespace App\Http\Controllers\Student;

use App\Modifications\Create\CreateCertificateModification;
use Illuminate\Http\Request;


class CertificateController extends BaseController
{
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