<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = true;
    
    protected $hidden = [
        'user_id','updated_at','created_at','deleted_at'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
