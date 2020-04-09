<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Departament extends Model
{
    use SoftDeletes,HasHistories,CascadeSoftDeletes;

    public function getModelLabel()
    {
        return $this->display_name;
    }

    protected $cascadeDeletes = ['groups'];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    protected $hidden = [
        'created_at','deleted_at','updated_at'
    ];

    protected $fillable  = [
        'dep_name_full','qualification','image','info','studysperiod'
    ];

    protected $casts = [
        'info' => 'array'
    ];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}