<?php

namespace App\Modifications;


abstract class BaseModification
{
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    public $model;
    /**
     * base constructor
     */
    public function __construct() {
        $this->model = $this->getModelClass()!="" ? app($this->getModelClass()) : null;
    }
    /**
     * @return Illuminate\Database\Eloquent\Model
     */
    protected abstract function getModelClass();

    public function startCondition(){
        return clone $this->model;
    }
}