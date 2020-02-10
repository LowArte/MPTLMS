<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ModelRepository\FeedbackRepository;
use Illuminate\Http\Request;

class RequestFeedbackController extends BaseController
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(FeedbackRepository $feedbackRepository)
    {
        $feedback = $feedbackRepository->getFeedback();
        return view('roles.admin.requests-users', compact('feedback'));
    }
}
