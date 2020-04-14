<?php

namespace App\Models;

use App\Models\Student;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Panoscape\History\HasOperations;
use Panoscape\History\HasHistories;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens,HasOperations,HasHistories;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','secName','thirdName','disabled','post_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'created_at', 'deleted_at', 'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function post()
    {
        return $this->hasOne(UsersPost::class,'id','post_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class,'user_id','id');
    }

    public function getModelLabel()
    {
        return $this->display_name;
    }
    
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