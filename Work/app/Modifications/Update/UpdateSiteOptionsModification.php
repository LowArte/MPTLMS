<?php

namespace App\Modifications\Update;

use App\Models\SiteOptions as Model;
use App\Modifications\BaseModification;

class UpdateSiteOptionsModification extends BaseModification
{
    protected function getModelClass(){
        return Model::class;
    }

    public function updatePanelControlOptions($id,$data){
        $siteOption =  $this->startCondition()->find($id);
        $siteOption->option_value = $data;
        $siteOption->save();
        return true;
    }
}