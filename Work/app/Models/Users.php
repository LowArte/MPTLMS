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
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, SoftDelete;
    public $timestamps = true;

    protected $guarded  = [
        'password', 'password_notHash', 'created_at', 'deleted_at', 'updated_at', 'login_stud', 'id'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
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
}
