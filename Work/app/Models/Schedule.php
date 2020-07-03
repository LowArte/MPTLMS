<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Schedule extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return "Расписания";
    }
    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];



    protected $fillable  = [
        'schedule','group_id'
    ];

    public function group()
    {
        return $this->hasOne(Group::class,"id","group_id");
    }
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}