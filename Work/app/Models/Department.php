<?php

namespace App\Models;

use Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Department extends Model
{
    use SoftDeletes,HasHistories,CascadeSoftDeletes;

    public function getModelLabel()
    {
        return "Специальностей";
    }

    protected $cascadeDeletes = ['groups'];

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