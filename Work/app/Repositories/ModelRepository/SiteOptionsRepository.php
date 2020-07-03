<?php

namespace App\Repositories\ModelRepository;

use App\Models\SiteOptions as Model;

class SiteOptionsRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }
    /** 
     * get option for control panel 
     * @return App\Models\SiteOptions
    */
    public function getOptionsForPanelControl()
    {
        $columns = ['id','option_name','option_value'];
        $result = $this->startCondition()
                        ->select($columns)
                        ->toBase()
                        ->first();
        return $result;
    }

    public function getIsProfilactic(){
        $columns = ['option_value'];
        $result = $this->startCondition()->select($columns)->where("id",1)->toBase()->first()->option_value;
        return $result == "true";
    }

    public function getProfilacticInfo(){
        $columns = ['id','option_value'];
        $result = $this->startCondition()->select($columns)->where("id",1)->toBase()->first();
        return $result;
    }
}