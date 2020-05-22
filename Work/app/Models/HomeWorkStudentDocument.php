<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class HomeWorkStudentDocument extends Model
{
    use HasHistories;

    public function getModelLabel()
    {
        return "Ассоциации";
    }
    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    protected $fillable  = [
        ''
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
