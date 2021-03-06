<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Places extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return "Мест проведения";
    }

    protected $fillable  = [
        'place_name','info'
    ];

    protected $casts = [
        'info' => 'array',
    ];

    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
