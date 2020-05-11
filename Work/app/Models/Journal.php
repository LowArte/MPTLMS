<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Journal extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return "Журналов";
    }
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $casts = [
        'journal' => 'array'
    ];

    protected $fillable  = [
         'isClose', 'journal','group_id','discip_id'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
