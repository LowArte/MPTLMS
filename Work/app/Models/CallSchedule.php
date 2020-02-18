<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class CallSchedule extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return $this->display_name;
    }
    
    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public function place()
    {
        return $this->hasOne(Places::class,'id','place_id');
    }
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
