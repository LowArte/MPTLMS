<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Create\CreateCertificateModification;
use Illuminate\Http\Request;
use App\Repositories\ModelRepository\CertificateRepository;

class CertificateController extends BaseController
{ 
    /**
     * get certificates from database
     * @return JSON
     */
    public function getCertificates(CertificateRepository $certificateRepository)
    {
        $certificates = $certificateRepository->getCertificates();
        return response()->json(compact('certificates'));
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