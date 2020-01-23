<?php

namespace App\Http\Controllers\Chancellery;

use App\Repositories\CertificateRepository;
use Illuminate\Http\Request;

class ListCertificateController extends BaseController
{
    /**
     * Show the application list certificate page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CertificateRepository $certificateRepository)
    {
        $requests = $certificateRepository->getCertificates();
        return view('roles.chancellery.list-certificate', compact('requests'));
    }
}
