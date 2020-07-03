<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Teacher;
use App\Notifications\FeedbackAnswer;
use App\Notifications\CertificateAnswerAccess;
use App\Notifications\CertificateAnswerCancel;
use App\Notifications\NewUser;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Panoscape\History\HasOperations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens,HasOperations,HasHistories, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','secName','disabled','post_id'
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

    protected $appends = ['full_name','full_name_inverted','not_short_fio'];

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
        return "Пользователей";
    }

    public function getFullNameAttribute(){
        $thirdName = $this->thirdName ? ".".mb_substr($this->thirdName, 0, 1, "UTF-8").". " : ". ";
        return mb_substr($this->name, 0, 1, "UTF-8").$thirdName.$this->secName;
    }

    public function getNotShortFioAttribute(){
       
        return "{$this->secName} {$this->name} {$this->thirdName}";
    }

    public function getFullNameInvertedAttribute(){
        $thirdName = $this->thirdName ? ".".mb_substr($this->thirdName, 0, 1, "UTF-8")."." : ".";
        return $this->secName." ".mb_substr($this->name, 0, 1, "UTF-8").$thirdName;
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

     /**
     * Отправка ответа
     * 
     * @param string $token Required
     * 
     * @return void
     */
    public function sendAnswerForFeedback($data)
    {
        $this->notify(new FeedbackAnswer($data));
    }

    /**
     * Отправка ответа
     * 
     * @param string $token Required
     * 
     * @return void
     */
    public function sendAnswerForCertificateAccess($data)
    {
        $this->notify(new CertificateAnswerAccess($data));
    }

    /**
     * Отправка ответа
     * 
     * @param string $token Required
     * 
     * @return void
     */
    public function sendAnswerForCertificateCancel($data)
    {
        $this->notify(new CertificateAnswerCancel($data));
    }

    /**
     * Отправка ответа
     * 
     * @param string $token Required
     * 
     * @return void
     */
    public function sendEmailNewUser($data)
    {
        $this->notify(new NewUser($data));
    }
}