<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Feedback extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return "Обращений пользователя";
    }
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
