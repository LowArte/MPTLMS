<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Association extends Model
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
        'teacher_id', 'journal_id'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
