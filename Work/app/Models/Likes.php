<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Likes extends Model
{
    public function getModelLabel()
    {
        return $this->display_name;
    }
    
    public $timestamps = true;

    protected $fillable  = [
        'user_id','news_id','links'
    ];

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
