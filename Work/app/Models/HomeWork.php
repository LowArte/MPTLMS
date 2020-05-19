<?php

namespace App\Models;

use App\Traits\CascadeNullDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class HomeWork extends Model
{
    use SoftDeletes, HasHistories, CascadeNullDeletes;

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
        return $this->hasOne(HomeWork::class,'id','homework_id');
    }
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}