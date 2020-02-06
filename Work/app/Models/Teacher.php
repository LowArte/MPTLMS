<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    
    protected $hidden = [
        'user_id','updated_at','created_at','deleted_at'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->hasOne(User::class,'user_id','id');
    }
}
