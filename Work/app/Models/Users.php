<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Debugbar;

class Users extends Model
{


    protected $fillable = [
        'login_email', 'login_stud', 'password', 'api_token','post_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public static function whereEmail($var = null)
    {
        $object = Users::all()->where('login_email',$var);
        return $object;
    }

    public static function whereId($var = null)
    {
        $object = Users::all()->where('id',$var);
        return $object;
    }

    public function info() {
        return [
            'user_id' => $this->id,
            'api_token' => $this->api_token
        ];
    }
}
