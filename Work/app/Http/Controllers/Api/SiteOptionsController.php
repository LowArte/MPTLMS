<?php

namespace App\Http\Controllers\Api;

use App\Modifications\Update\UpdateSiteOptionsModification;
use App\Repositories\ModelRepository\SiteOptionsRepository;
use Illuminate\Http\Request;

use Debugbar;
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
    /**
     * save option by id to Model SiteOptions
     * @return JSON
     */
    public function setOptions(Request $request,UpdateSiteOptionsModification $updateSiteOptions)
    {
        $data = $request->all();

        $result =  $updateSiteOptions->updatePanelControlOptions($data['id'],$data['value']);

        if($result){
            return response()->json(["success"=>true]);
        }

        return response()->json([],500);
        
    }
}