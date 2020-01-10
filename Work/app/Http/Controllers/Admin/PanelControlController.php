<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modifications\Update\UpdateSiteOptionsModification;
use App\Repositories\SiteOptionsRepository;
use Illuminate\Http\Request;

class PanelControlController extends BaseController
{
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
    /**
     * Show the application user control panel page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(SiteOptionsRepository $siteOptionsRepository)
    {
        $options = $siteOptionsRepository->getOptionsForPanelControl();
        return view('roles.admin.panel-control', compact('options'));
    }
}
