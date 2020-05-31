<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsComments extends Model
{

    protected $fillable  = [
        'text','user_id','news_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
