<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;


class HomeWorkStudent extends Model
{
    use HasHistories;

    protected $table = 'home_work_students';

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $fillable  = [
        'association_home_work_id', 'student_id', 'info'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
