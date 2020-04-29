<?php

namespace App\Models;

use App\Models\Likes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class News extends Model
{
    use HasHistories;

    public function getModelLabel()
    {
        return $this->display_name;
    }

    protected $cascadeDeletes = ['likes'];

    public $timestamps = true;

    protected $hidden = [
        'deleted_at','updated_at'
    ];

    protected $fillable  = [
        'title','text','images','links'
    ];

    protected $casts = [
        'images' => 'array',
        'links'=>'array'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}