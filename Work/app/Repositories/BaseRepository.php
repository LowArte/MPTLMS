<?php

namespace App\Repositories;

abstract class BaseRepository
{
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct() {
        $this->model = $this->getModelClass()!="" ? app($this->getModelClass()) : null;
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