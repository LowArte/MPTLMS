<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class HomeWorkStudentDocument extends Model
{
    use HasHistories;

    protected $table = 'home_work_student_documents';

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $fillable  = [
        'home_work_student_id', 'path', 'name'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
