<?php

namespace App\Models;

use App\Models\Likes;
use Debugbar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class News extends Model
{
    use HasHistories;

    public function getModelLabel()
    {
        return "Новостей";
    }

    protected $cascadeDeletes = ['likes'];

    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $fillable  = [
        'title', 'text', 'images', 'links'
    ];

    protected $appends = ['normal_images'];

    protected $casts = [
        'images' => 'array',
        'links' => 'array'
    ];

    public function getNormalImagesAttribute()
    {
        $result = [];
        $images = json_decode($this->images);

        foreach ($images as $link) {
            array_push(
                $result,
                [
                    "url" => asset("storage/news/" . $this->id . '//' . $link->name),
                ]
            );
        }

        return $result;
    }

    public function comments()
    {
        return $this->hasMany(NewsComments::class);
    }

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
