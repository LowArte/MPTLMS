<?php

namespace App\Models;

use App\Traits\CascadeNullDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class AssociationUsersHomeWork extends Model
{
    use SoftDeletes, HasHistories, CascadeNullDeletes;

    protected $table = 'association_users_home_work';

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'deleted_at', 'updated_at'
    ];

    protected $fillable  = [
        'user_id','home_work_id'
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}