<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPost extends Model
{
    public $timestamps = true;
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
