<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPost extends Model
{
    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
