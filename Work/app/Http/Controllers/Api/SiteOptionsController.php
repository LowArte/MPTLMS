<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ModelRepository\SiteOptionsRepository;

class SiteOptionsController extends BaseController
{ 

    /**
     * get SiteOptions from database
     * @return JSON
     */
    public function getSiteOptions(SiteOptionsRepository $siteOptionsRepository)
    {
        $siteOptions = $siteOptionsRepository->getOptionsForPanelControl();
        return response()->json(compact('siteOptions'));
    }
}