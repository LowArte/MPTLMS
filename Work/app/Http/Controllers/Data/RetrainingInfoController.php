<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/** Контроллер терализующий функциональные возможности
 *   карточек дополнительного образования 
 */
class RetrainingInfoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'profilactic']);
    }
}
