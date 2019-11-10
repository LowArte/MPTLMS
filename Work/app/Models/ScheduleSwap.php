<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleSwap extends Model
{
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
