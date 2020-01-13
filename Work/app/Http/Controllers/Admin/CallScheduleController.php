<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CallScheduleRepository;
use Illuminate\Http\Request;

class CallScheduleController extends BaseController
{
    /**
     * Show the application call schedule page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CallScheduleRepository $callScheduleRepository)
    {
        $timeTable = $callScheduleRepository->getCallSchedule();
        return view('roles.admin.call-schedule',compact('timeTable'));
    }
}
