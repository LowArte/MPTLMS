<?php

namespace App\Http\Controllers\Api;

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
}