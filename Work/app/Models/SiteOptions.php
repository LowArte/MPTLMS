<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class SiteOptions extends Model
{
    use SoftDeletes, HasHistories;
    public $timestamps = true;

    public function getModelLabel()
    {
        return $this->display_name;
    }

    protected $hidden = [
        'deleted_at', 'updated_at','created_at'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}