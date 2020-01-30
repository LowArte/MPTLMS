<?php

namespace App\Http\Controllers;

class WarningController extends Controller
{
    /**
     * Show the application warning page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/roles/warning');
    }
}
