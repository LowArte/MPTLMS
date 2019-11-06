<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPassword;

/**
 * User model
 * 
 * @category Model
 * 
 * @package Illuminate\Foundation\Auth\User
 * 
 * @author Пикалов Артем <p_a.n.pikalov@mpt.ru>
 * 
 * @license MPT 
 * 
 * @link https://mpt.ru/
 */
class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email_verified_at','created_at','updated_at'
    ];

    /**
     * Sending password reset Notification
     * 
     * @param string $token Required
     * 
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
