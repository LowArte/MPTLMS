<?php

namespace App\Repositories\ModelRepository;

abstract class BaseRepository
{
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct() {
        $this->model = app($this->getModelClass());
    }

    /**
    * @return  Illuminate\Database\Eloquent\Model
    */
    abstract protected function getModelClass();
    /**
     * Execute model logic
     * @return Illuminate\Database\Eloquent\Model
     */
    protected function startCondition(){
        return clone $this->model;
    }
}