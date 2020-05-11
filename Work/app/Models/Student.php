<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Student extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at', 'departments_id'
    ];

    function group(){
        return $this->hasOne(Group::class,'id','group_id');
    }

    function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
