<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes as SoftDelete;

class Users extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail,SoftDelete;

    protected $fillable = [
        'login_email', 'login_stud', 'password', 'api_token', 'post_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public static function whereEmail($var = null)
    {
        $object = Users::all()->where('login_email', $var);
        return $object;
    }

    public static function whereId($var = null)
    {
        $object = Users::all()->where('id', $var);
        return $object;
    }

    public function info()
    {
        return [
            'user_id' => $this->id,
            'api_token' => $this->api_token
        ];
    }
}
