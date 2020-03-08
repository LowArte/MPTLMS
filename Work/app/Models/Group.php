<?php

namespace App\Models;

use App\Traits\CascadeNullDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class Group extends Model
{
    use SoftDeletes,HasHistories, CascadeNullDeletes;

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at', 'departament_id'
    ];

    protected $cascadeDeletes = ['students'=>'group_id'];

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function departament()
    {
        return $this->hasOne(Departament::class);
    }

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
