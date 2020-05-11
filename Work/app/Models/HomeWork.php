<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class HomeWork extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return "Домашних заданий";
    }
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $fillable  = [
        
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
