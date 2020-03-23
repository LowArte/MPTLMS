<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class UsersPost extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return $this->display_name;
    }

    public $timestamps = true;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'privilegies'
    ];

    protected $casts = [
        'privilegies' => 'array'
      ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }

    public function users()
    {
        return $this->hasMany(User::class,'post_id','id');
    }
}