<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Likes extends Model
{
    use SoftDeletes;

    public function getModelLabel()
    {
        return $this->display_name;
    }
    
    public $timestamps = true;

    protected $fillable  = [
        'value','user_id','news_id','links'
    ];

    protected $casts = [
        'value' => 'boolean'
    ];

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
