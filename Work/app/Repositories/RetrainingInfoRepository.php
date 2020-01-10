<?php

namespace App\Repositories;

use App\Models\RetrainingInfo as Model;
use Illuminate\Database\Eloquent\Collection;

class RetrainingInfoRepository extends BaseRepository
{
    protected function getModelClass(){
        return Model::class;
    }
    /** 
     * get collection of retraining info
     * @return Illuminate\Database\Eloquent\Collection
    */
    public function getRetrainingInfo()
    {
        $columns = ['id','href','title','cost','time','text'];
        $result = $this->startCondition()->select($columns)->toBase()->get();
        return $result;
    }
}