<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Group extends Model
{
    use SoftDeletes,HasHistories;

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at', 'departaments_id'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
