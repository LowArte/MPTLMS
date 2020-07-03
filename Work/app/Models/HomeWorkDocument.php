<?php

namespace App\Models;

use App\Traits\CascadeNullDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Panoscape\History\HasHistories;

class HomeWorkDocument extends Model
{
    use HasHistories;

    protected $table = 'home_work_documents';

    public function getModelLabel()
    {
        return $this->display_name;
    }
    public $timestamps = true;

    protected $hidden = [
        'updated_at'
    ];

    protected $fillable  = [
         'home_work_id', 'path','name'
    ];
    
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
