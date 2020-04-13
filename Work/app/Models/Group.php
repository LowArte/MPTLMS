<?php

namespace App\Models;

use App\Traits\CascadeNullDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

use Debugbar;
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

    public function getFullName($name = ''){
        if($this->child_id == null){
            return $name.$this->group_name;
        }
        return $this->child->getFullName($this->group_name.',');
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function child(){
        return $this->hasOne(Group::class,"id","child_id");
    }

    public function haveParent(){
        $data = Group::where("child_id",$this->id)->first();
        return  $data == null;
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
