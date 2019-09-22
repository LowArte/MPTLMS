<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function addUser()
    {
        DB::table('Users')->insert($_POST);
    }
}
