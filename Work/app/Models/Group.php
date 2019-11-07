<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at', 'departaments_id'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
