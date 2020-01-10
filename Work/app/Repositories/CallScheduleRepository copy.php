<?php

namespace App\Repositories;

use App\Models\CallSchedule as Model;

class SiteOptionsRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function getCallSchedule(){
        
    }

}