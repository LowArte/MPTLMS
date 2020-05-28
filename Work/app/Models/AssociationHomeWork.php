<?php

namespace App\Models;

use App\Traits\CascadeNullDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class AssociationHomeWork extends Model
{
    use SoftDeletes, HasHistories, CascadeNullDeletes;

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $fillable  = [
        'home_work_id','group_id'
    ];

    public function homework()
    {
        return $this->hasOne(HomeWork::class,'id','home_work_id');
    }

    public function group()
    {
        return $this->hasOne(Group::class,"id","group_id");
    }

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}