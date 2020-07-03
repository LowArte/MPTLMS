<?php

namespace App\Models;

use App\Traits\CascadeNullDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class HomeWork extends Model
{
    use SoftDeletes, HasHistories, CascadeNullDeletes;

    protected $table = 'home_work';

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $fillable  = [
        'user_id','info','type'
    ];

    public function homework()
    {
        return $this->hasOne(HomeWork::class,'id','home_work_id');
    }

    public function associationHomework()
    {
        return $this->hasMany(AssociationHomeWork::class,'home_work_id', 'id');
    }

    public function associationUserHomework()
    {
        return $this->hasMany(AssociationUsersHomeWork::class,'home_work_id','id');
    }
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}