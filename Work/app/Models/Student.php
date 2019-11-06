<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Student model
 * 
 * @category Model
 * 
 * @package App\Models
 * 
 * @author Пикалов Артем <p_a.n.pikalov@mpt.ru>
 * 
 * @license MPT 
 * 
 * @link https://mpt.ru/
 */
class Student extends Model
{
    public $timestamps = true;

    protected $hidden = [
        'user_id','updated_at','created_at','deleted_at'
    ];

    /**
     * Construct
     * 
     * @param array $attributes construct attributes 
     */
    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
    }
}
