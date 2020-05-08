<?php

namespace App\Http\Controllers\Api;

use App\Models\DepartmentBuffer;

class DepartmentBufferController extends BaseController
{ 
    public function create(){
        DepartmentBuffer::create();
        return response()->json();
    }
}