<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Support\Facades\Auth;

class NewsConstructorController extends BaseController
{
    /**
     * Show feedback page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.editor.news-constructor');
    }
}
