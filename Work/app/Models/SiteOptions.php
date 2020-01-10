<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteOptions extends Model
{
    use SoftDeletes;
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at','created_at'
    ];


    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
