<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersPost extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }

    public function users()
    {
        return $this->hasMany(User::class,'post_id','id');
    }
}