<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departament extends Model
{
    use SoftDeletes;
    public $timestamps = true;

    protected $hidden = [
        'created_at','deleted_at','updated_at'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
